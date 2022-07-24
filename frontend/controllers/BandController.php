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
                    'article-create',
                    'member-add'
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
            ->leftJoin('album_genre', 'album_genre.band_id = band.id')
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
            
            foreach ($diff as $key => $value) {
                $submission = new EditSubmission();
                $submission->table = 'band';
                $submission->column = $key;
                $submission->element_id = $model->id;
                $submission->old_data = (string)$value['old'];
                $submission->new_data = (string)$value['new'];
                $submission->setValues();
                if ($submission->save()) {
                    \Yii::$app->session->setFlash('success', 'Submission saved');
                } else {
                    foreach ($submission->getErrors() as $attributes) {
                        foreach ($attributes as $error) {
                            \Yii::$app->session->setFlash('error', $error);
                        }
                    }
                }
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
