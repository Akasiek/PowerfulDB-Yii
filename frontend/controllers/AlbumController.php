<?php

namespace frontend\controllers;

use common\models\Album;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AlbumController extends Controller
{
    public function actionIndex()
    {
        $query = Album::find()
            ->with('createdBy')
            ->leftJoin('artist', 'artist.id = album.artist_id')
            ->leftJoin('band', 'band.id = album.band_id');

        // Check if any filters are set
        $filters = \Yii::$app->request->get();
        if (isset($filters['from_year']) && $filters['from_year'] != '') {
            $query->andWhere('YEAR(release_date) >= :from_year', [':from_year' => $filters['from_year']]);
        }
        if (isset($filters['to_year']) && $filters['to_year'] != '') {
            $query->andWhere('YEAR(release_date) <= :to_year', [':to_year' => $filters['to_year']]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
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

            // Check if author is an artist or band and set the appropriate id
            $author_id = \Yii::$app->request->post('author_id');
            $author = explode('-', $author_id);
            if ($author[0] == 'artist') {
                $model->artist_id = $author[1];
            } else {
                $model->band_id = $author[1];
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
}