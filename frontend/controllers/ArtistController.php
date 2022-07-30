<?php

namespace frontend\controllers;

use common\models\Artist;
use common\models\ArtistArticle;
use common\models\EditSubmission;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

include \Yii::getAlias('@frontend/web/checkModelDiff.php');

class ArtistController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'edit', 'article-create'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'popularity' => [
                    'desc' => ['artist.views' => SORT_DESC],
                ],
                'name' => [
                    'asc' => ['artist.name' => SORT_ASC],
                    'desc' => ['artist.name' => SORT_DESC],
                ],
                'birth_date' => [
                    'asc' => ['artist.birth_date' => SORT_ASC],
                    'desc' => ['artist.birth_date' => SORT_DESC],
                ],
            ],
            'defaultOrder' => ['name' => SORT_ASC],
        ]);

        $query = Artist::find()->orderBy($sort->orders)
            ->leftJoin('album', 'album.artist_id = artist.id')
            ->leftJoin('album_genre', 'album_genre.album_id = album.id')
            ->leftJoin('genre', 'genre.id = album_genre.genre_id')
            ->distinct();

        // Check if any filters are set
        $filters = \Yii::$app->request->get();
        if (isset($filters['birth_from_year']) && $filters['birth_from_year'] != '') {
            $query->andWhere(
                'EXTRACT(YEAR FROM birth_date) >= :from_year',
                [':from_year' => $filters['birth_from_year']]
            );
        }
        if (isset($filters['birth_to_year']) && $filters['birth_to_year'] != '') {
            $query->andWhere(
                '
            EXTRACT(YEAR FROM birth_date) <= :to_year',
                [':to_year' => $filters['birth_to_year']]
            );
        }
        if (isset($filters['death_from_year']) && $filters['death_from_year'] != '') {
            $query->andWhere(
                'EXTRACT(YEAR FROM death_date) >= :from_year',
                [':from_year' => $filters['death_from_year']]
            );
        }
        if (isset($filters['death_to_year']) && $filters['death_to_year'] != '') {
            $query->andWhere(
                '
            EXTRACT(YEAR FROM death_date) <= :to_year',
                [':to_year' => $filters['death_to_year']]
            );
        }
        if (isset($filters['genre']) && !empty($filters['genre'])) {
            $query->andWhere(
                'genre.name ILIKE :genre',
                [':genre' => '%' . trim($filters['genre']) . '%']
            );
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
        $model = Artist::findOne(['slug' => $slug]);

        // If user refreshed site, don't count view
        if (Url::current() !== Url::previous()) {
            $model->views += 1;
            $model->save();
            Url::remember();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Artist();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'slug' => $model->slug]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionEdit($slug)
    {
        $model = Artist::findOne(['slug' => $slug]);

        if ($model->load(\Yii::$app->request->post())) {
            $diff = checkModelDiff($model);

            foreach ($diff as $column => $value) {
                $submission = new EditSubmission();
                $submission->setValues('artist', $column, $model->id, (string)$value['old'], (string)$value['new']);
                $submission->saveSubmission();
            }
            return $this->redirect(['view', 'slug' => $model->slug]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    public function actionArticleCreate($slug)
    {
        $model = new ArtistArticle();
        $artist = Artist::findOne(['slug' => $slug]);

        if ($model->load(\Yii::$app->request->post())) {
            $model->artist_id = $artist->id;
            if ($model->save()) {
                return $this->redirect(['view', 'slug' => $slug]);
            }
        } else {
            return $this->render('article/create', [
                'model' => $model,
            ]);
        }
    }

    public function actionArticleEdit($slug)
    {
        $artist = Artist::findOne(['slug' => $slug]);
        $model = ArtistArticle::findOne(['artist_id' => $artist->id]);

        if ($model->load(\Yii::$app->request->post())) {
            // For each changed field, create a new edit submission
            $diff = checkModelDiff($model);
            foreach ($diff as $column => $value) {
                $submission = new EditSubmission();
                if ($column === 'text') {
                    $submission->setArticleValues('artist_article', $column, $model->id, (string)$value['old'], (string)$value['new']);
                } else {
                    $submission->setValues('artist_article', $column, $model->id, (string)$value['old'], (string)$value['new']);
                }
                $submission->saveSubmission();
            }
            return $this->redirect(['view', 'slug' => $slug]);
        } else {
            return $this->render('article/edit', [
                'model' => $model,
            ]);
        }
    }
}
