<?php

namespace frontend\controllers;

use common\models\Band;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class BandController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Band::find()->with('createdBy'),
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
        $model = Band::findOne(['slug' => $slug]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
