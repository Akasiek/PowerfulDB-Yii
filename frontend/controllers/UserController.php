<?php

namespace frontend\controllers;

use common\models\User;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 16,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = User::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
