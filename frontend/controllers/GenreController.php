<?php

namespace frontend\controllers;

use common\models\Genre;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class GenreController extends Controller
{
    public function actionIndex()
    {
        // Get all genres and their count in album_genre table
        $query = Genre::find()->select(['genre.name', 'genre.slug', 'COUNT(album_genre.album_id) AS countGenre'])
            ->leftJoin('album_genre', 'album_genre.genre_id = genre.id')
            ->groupBy(['genre.name', 'genre.slug'])
            ->orderBy('countGenre DESC');

        // Check if name filter is set
        $filters = \Yii::$app->request->get();
        if (isset($filters['name']) && $filters['name'] != '') {
            $query->andWhere('genre.name ILIKE :name', [':name' => '%' . $filters['name'] . '%']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Genre();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
