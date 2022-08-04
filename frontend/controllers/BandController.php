<?php

namespace frontend\controllers;

use common\models\Band;
use common\models\BandArticle;
use common\models\BandMember;
use common\models\EditSubmission;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\helpers\Url;
use yii\web\Controller;

include \Yii::getAlias('@frontend/web/checkModelDiff.php');

class BandController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => [
                    'create',
                    'edit',
                    'article-create',
                    'member-add',
                    'member-edit',
                    'member-delete',
                ],
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
                    'desc' => ['band.views' => SORT_DESC],
                ],
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
            ->leftJoin('album', 'album.band_id = band.id')
            ->leftJoin('album_genre', 'album_genre.album_id = album.id')
            ->leftJoin('genre', 'genre.id = album_genre.genre_id')
            ->distinct();

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
        if (isset($filters['genre']) && $filters['genre'] != '') {
            $query->andWhere(array('IN', 'album_genre.genre_id', $filters['genre']));
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
        $model = Band::findOne(['slug' => $slug]);

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
        $model = new Band();

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
        $model = Band::findOne(['slug' => $slug]);

        if ($model->load(\Yii::$app->request->post())) {
            $diff = checkModelDiff($model);

            foreach ($diff as $column => $value) {
                $submission = new EditSubmission();
                $submission->setValues('band', $column, $model->id, (string)$value['old'], (string)$value['new']);
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

    public function actionArticleEdit($slug)
    {
        $band = Band::findOne(['slug' => $slug]);
        $model = BandArticle::findOne(['band_id' => $band->id]);

        if ($model->load(\Yii::$app->request->post())) {
            // For each changed field, create a new edit submission
            $diff = checkModelDiff($model);
            foreach ($diff as $column => $value) {
                $submission = new EditSubmission();
                if ($column === 'text') {
                    $submission->setArticleValues('band_article', $column, $model->id, (string)$value['old'], (string)$value['new']);
                } else {
                    $submission->setValues('band_article', $column, $model->id, (string)$value['old'], (string)$value['new']);
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
            return $this->render('member/add', [
                'model' => $model,
                'band' => $band,
            ]);
        }
    }

    public function actionMemberEdit($bandSlug, $memberId)
    {
        $model = BandMember::find()->where(['id' => $memberId])->with(['artist', 'band'])->one();
        $band = Band::findOne(['slug' => $bandSlug]);

        if ($model->load(\Yii::$app->request->post())) {
            // Create edit submission for each changed field
            $diff = checkModelDiff($model);
            foreach ($diff as $column => $value) {
                $submission = new EditSubmission();
                $submission->setValues('band_member', $column, $model->id, (string)$value['old'], (string)$value['new']);
                $submission->saveSubmission();
            }
            return $this->redirect(['view', 'slug' => $bandSlug]);
        } else {
            return $this->render('member/edit', [
                'model' => $model,
                'band' => $band,
            ]);
        }
    }

    public function actionMemberDelete($bandSlug, $memberId)
    {
        // Create submission for member deletion
        $bandMember = BandMember::findOne($memberId);
        $submission = new EditSubmission();
        $submission->setValues('band_member', 'delete', $bandMember->id, (string)$bandMember->id, '0');
        $submission->saveSubmission();
        return $this->redirect(['/band/view', 'slug' => $bandSlug]);
    }
}
