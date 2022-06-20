<?php

use common\models\BandMember;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Band Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="band-member-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Band Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
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
                'urlCreator' => function ($action, BandMember $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
