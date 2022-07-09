<?php

namespace frontend\controllers;

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use common\models\User;
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
            'query' => Artist::find()->byKeyword($keyword)->limit(16),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
            'pagination' => false,
        ]);
        $bands = new ActiveDataProvider([
            'query' => Band::find()->byKeyword($keyword)->limit(16),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
            'pagination' => false,
        ]);
        $albums = new ActiveDataProvider([
            'query' => Album::find()->byKeyword($keyword)->with('artist')->with('band')->limit(18),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
            'pagination' => false,
        ]);
        $users = new ActiveDataProvider([
            'query' => User::find()->byKeyword($keyword)->limit(12),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
            'pagination' => false,
        ]);

        return $this->render('index', [
            'keyword' => $keyword,
            'artists' => $artists,
            'bands' => $bands,
            'albums' => $albums,
            'users' => $users,
        ]);
    }
}
