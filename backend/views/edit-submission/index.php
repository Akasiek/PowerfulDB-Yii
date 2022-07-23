<?php

use common\models\EditSubmission;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Edit Submissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edit-submission-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Edit Submission', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'table',
            'column',
            'element_id',
            'old_data',
            'new_data',
            //'status',
            //'created_by',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, EditSubmission $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
