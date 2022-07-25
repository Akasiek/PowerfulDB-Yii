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
        if ($element instanceof Album && $model->column === 'author_id') {
            // Set artist and band ids to null to make sure that if author is different type, there will be no double artist or band
            $element->artist_id = null;
            $element->band_id = null;

            $newAuthor = explode('-', $model->new_data);
            if ($newAuthor[0] === 'artist') {
                $element->artist_id = $newAuthor[1];
            } elseif ($newAuthor[0] === 'band') {
                $element->band_id = $newAuthor[1];
            }

        } else {
            $element->{$model->column} = $model->new_data;
        }

        $element->updated_at = $model->created_at;
        $element->updated_by = $model->created_by;
        if ($element->save()) {
            $model->status = EditSubmission::STATUSES['approved'];
            if ($model->save()) $this->redirect([
                $model->table . '/view',
                'slug' => $element->slug,
            ]);
        }
    }

    public function actionReject($id)
    {
        $model = EditSubmission::find()->where(['id' => $id])->one();
        $model->status = EditSubmission::STATUSES['rejected'];
        if ($model->save()) $this->redirect(['index']);
    }
}