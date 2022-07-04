<?php

namespace frontend\controllers;

use common\models\Band;
use common\models\BandArticle;
use common\models\BandMember;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\web\Controller;

class BandController extends Controller
{
    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'name' => [
                    'asc' => ['band.name' => SORT_ASC],
                    'desc' => ['band.name' => SORT_DESC],
                ],
                'founding_year' => [
                    'asc' => ['band.founding_year' => SORT_ASC],
                    'desc' => ['band.founding_year' => SORT_DESC],
                ],
            ],
            'defaultOrder' => ['name' => SORT_ASC],
        ]);

        $query = Band::find()->orderBy($sort->orders)
            ->leftJoin('album_genre', 'album_genre.band_id = band.id')
            ->leftJoin('genre', 'genre.id = album_genre.genre_id');

        // Check if any filters are set
        $filters = \Yii::$app->request->get();
        if (isset($filters['founding_from_year']) && !empty($filters['founding_from_year'])) {
            $query->andWhere(
                'founding_year >= :from_year',
                [':from_year' => $filters['founding_from_year']]
            );
        }
        if (isset($filters['founding_to_year']) && !empty($filters['founding_to_year'])) {
            $query->andWhere(
                'founding_year <= :to_year',
                [':to_year' => $filters['founding_to_year']]
            );
        }
        if (isset($filters['break_up_from_year']) && !empty($filters['break_up_from_year'])) {
            $query->andWhere(
                'breakup_year >= :from_year',
                [':from_year' => $filters['break_up_from_year']]
            );
        }
        if (isset($filters['break_up_to_year']) && !empty($filters['break_up_to_year'])) {
            $query->andWhere(
                'breakup_year <= :to_year',
                [':to_year' => $filters['break_up_to_year']]
            );
        }
        if (isset($filters['genre']) && !empty($filters['genre'])) {
            $query->andWhere(
                'genre.name ILIKE :genre',
                [':genre' => '%' . $filters['genre'] . '%']
            );
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'sort' => $sort,
        ]);
    }

    public function actionView($slug)
    {
        $model = Band::findOne(['slug' => $slug]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Band();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'slug' => $model->slug]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionArticleCreate($slug)
    {
        $model = new BandArticle();
        $band = Band::findOne(['slug' => $slug]);

        if ($model->load(\Yii::$app->request->post())) {
            $model->band_id = $band->id;
            if ($model->save()) {
                return $this->redirect(['view', 'slug' => $slug]);
            }
        } else {
            return $this->render('article/create', [
                'model' => $model,
            ]);
        }
    }

    public function actionMemberAdd($slug)
    {
        $model = new BandMember();
        $band = Band::findOne(['slug' => $slug]);

        if ($model->load(\Yii::$app->request->post())) {
            $model->band_id = $band->id;
            if ($model->artist_id === '0') $model->artist_id = null;

            if ($model->save()) {
                return $this->redirect(['view', 'slug' => $slug]);
            }
        } else {
            return $this->render('member_add', [
                'model' => $model,
                'band' => $band,
            ]);
        }
    }
}
