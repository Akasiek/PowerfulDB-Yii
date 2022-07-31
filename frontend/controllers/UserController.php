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

    public function actionSettings()
    {
        $model = User::findOne(\Yii::$app->user->id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Settings saved');
            return $this->redirect(['/user/view', 'id' => $model->id]);
        } else {
            return $this->render('settings', [
                'model' => $model,
            ]);
        }
    }
}
