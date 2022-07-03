<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\AlbumGenre;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Album Genres';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-genre-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Album Genre', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Genre name',
                'attribute' => 'genre.name',
            ],
            [
                'label' => 'Album title',
                'attribute' => 'album.title',
            ],
            [
                'label' => 'Artist name',
                'attribute' => 'artist.name',
            ],
            [
                'label' => 'Band name',
                'attribute' => 'band.name',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AlbumGenre $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>