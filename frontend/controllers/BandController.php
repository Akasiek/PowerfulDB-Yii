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
                    'default' => SORT_ASC,
                    'label' => 'Name',
                ],
                'birth_date' => [
                    'asc' => ['band.founding_year' => SORT_ASC],
                    'desc' => ['band.founding_year' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Founding Year',
                ],
            ],
            'defaultOrder' => ['name' => SORT_ASC],
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => Band::find()->orderBy($sort->orders),
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
