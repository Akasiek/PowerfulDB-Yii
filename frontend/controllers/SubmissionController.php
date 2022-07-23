<?php

namespace frontend\controllers;

use common\models\Album;
use common\models\EditSubmission;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class SubmissionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['submissionPanel'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        // Get submission where status is pending
        $dataProvider = new ActiveDataProvider([
            'query' => EditSubmission::find()->where(['status' => EditSubmission::STATUSES['pending']])->with('user'),
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
        $model = EditSubmission::find()->where(['id' => $id])->with('user')->one();
        $element = $model->getElement();
        return $this->render('view', [
            'model' => $model,
            'element' => $element,
        ]);
    }

    public function actionApprove($id)
    {
        $model = EditSubmission::find()->where(['id' => $id])->one();
        $element = $model->getElement();

        $element->{$model->column} = $model->new_data;
        if ($element->save()) {
            $model->status = EditSubmission::STATUSES['approved'];
            if ($model->save()) $this->redirect([
                $model->table . '/view',
                'slug' => $element->slug,
            ]);
        }
    }
}