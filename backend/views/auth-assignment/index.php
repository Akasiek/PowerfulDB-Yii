<?php

use common\models\AuthAssignment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auth Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Auth Assignment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_name',
            'user_id',
            'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AuthAssignment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
                }
            ],
        ],
    ]); ?>


</div>
