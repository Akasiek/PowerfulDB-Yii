<?php

namespace frontend\controllers;

use common\models\Album;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AlbumController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Album::find()
                ->with('createdBy')
                ->leftJoin('artist', 'artist.id = album.artist_id')
                ->leftJoin('band', 'band.id = album.band_id'),
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
        $model = Album::findOne(['slug' => $slug]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Album();


        if ($model->load(\Yii::$app->request->post())) {

            // Check if author is an artist or band and set the appropriate id
            $author_id = \Yii::$app->request->post('author_id');
            $author = explode('-', $author_id);
            if ($author[0] == 'artist') {
                $model->artist_id = $author[1];
            } else {
                $model->band_id = $author[1];
            }

            if ($model->save()) {
                return $this->redirect(['view', 'slug' => $model->slug]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
}