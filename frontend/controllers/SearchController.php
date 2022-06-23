<?php

namespace frontend\controllers;

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\BadRequestHttpException;

class SearchController extends Controller
{
    /**
     * Displays search results.
     *
     * @return mixed
     */
    public function actionIndex($keyword)
    {
        // If keyword is shorted than 2 characters, display error message
        if (strlen($keyword) < 2) {
            throw new BadRequestHttpException('Keyword must be at least 2 characters long.');
        }

        $artists = new ActiveDataProvider([
            'query' => Artist::find()->byKeyword($keyword),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
        $bands = new ActiveDataProvider([
            'query' => Band::find()->byKeyword($keyword),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
        $albums = new ActiveDataProvider([
            'query' => Album::find()->byKeyword($keyword)->with('artist')->with('band'),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
        return $this->render('index', [
            'keyword' => $keyword,
            'artists' => $artists,
            'bands' => $bands,
            'albums' => $albums,
        ]);
    }
}