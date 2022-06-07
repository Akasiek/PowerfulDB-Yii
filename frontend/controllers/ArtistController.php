<?php

namespace frontend\controllers;

use common\models\Artist;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class ArtistController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Artist::find()->with('createdBy'),
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
        $model = Artist::findOne(['slug' => $slug]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
