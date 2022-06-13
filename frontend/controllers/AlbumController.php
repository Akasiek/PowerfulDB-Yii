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

    public function actionView($slug, $author_slug)
    {
        $model = Album::findOne(['slug' => $slug, 'author_slug' => $author_slug]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}