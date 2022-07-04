<?php

namespace frontend\controllers;

use common\models\Album;
use common\models\AlbumArticle;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\web\Controller;

class AlbumController extends Controller
{
    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'title' => [
                    'asc' => ['album.title' => SORT_ASC],
                    'desc' => ['album.title' => SORT_DESC],
                ],
                'release_date' => [
                    'asc' => ['album.release_date' => SORT_ASC],
                    'desc' => ['album.release_date' => SORT_DESC],
                ],
            ],
            'defaultOrder' => ['release_date' => SORT_DESC],
        ]);

        $query = Album::find()
            ->leftJoin('artist', 'artist.id = album.artist_id')
            ->leftJoin('band', 'band.id = album.band_id')
            ->leftJoin('album_genre', 'album_genre.album_id = album.id')
            ->leftJoin('genre', 'genre.id = album_genre.genre_id')
            ->orderBy($sort->orders);


        // Check if any filters are set
        $filters = \Yii::$app->request->get();
        if (isset($filters['from_year']) && $filters['from_year'] != '') {
            $query->andWhere('EXTRACT(YEAR FROM release_date) >= :from_year', [':from_year' => $filters['from_year']]);
        }
        if (isset($filters['to_year']) && $filters['to_year'] != '') {
            $query->andWhere('EXTRACT(YEAR FROM release_date) <= :to_year', [':to_year' => $filters['to_year']]);
        }
        if (isset($filters['genre']) && $filters['genre'] != '') {
            $query->andWhere('genre.name ILIKE :genre', [':genre' => '%' . $filters['genre'] . '%']);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 24,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'sort' => $sort,
        ]);
    }

    public function actionView($slug)
    {
        $model = Album::findOne(['slug' => $slug]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Album();

        if ($model->load(\Yii::$app->request->post())) {

            // Check if author_id is set. If not, send an error message.
            $author_id = \Yii::$app->request->post('author_id');
            if ($author_id == '') {
                \Yii::$app->session->setFlash('author_id', 'Please select an artist or a band.');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

            // Check if author is an artist or band and set the appropriate id
            $author = explode('-', $author_id);
            if ($author[0] == 'artist') {
                $model->artist_id = $author[1];
            } else {
                $model->band_id = $author[1];
            }

            // Check if the album already exists
            $duplicate = Album::find()
                ->where(
                    'artist_id = :artist_id OR band_id = :band_id',
                    [':artist_id' => $model->artist_id, ':band_id' => $model->band_id]
                )
                ->andWhere('title = :title', [':title' => $model->title])
                ->one();
            if ($duplicate) {
                \Yii::$app->session->setFlash('duplicate', 'This album already exists.');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'slug' => $model->slug]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionArticleCreate($slug)
    {
        $model = new AlbumArticle();

        $album = Album::findOne(['slug' => $slug]);

        if ($model->load(\Yii::$app->request->post())) {
            $model->album_id = $album->id;
            if ($model->save()) {
                return $this->redirect(['view', 'slug' => $slug]);
            }
        } else {
            return $this->render('article/create', [
                'model' => $model,
            ]);
        }
    }
}
