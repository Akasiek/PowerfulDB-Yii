<?php
/**
 * @var $dataProvider ActiveDataProvider
 * @var $sort Sort
 */

use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<div class="px-14 py-8">

    <?= $this->render('@frontend/views/components/_index_page_title') ?>

    <?= $this->render('_album_sort_filter', [
        'sort' => $sort,
    ]) ?>


    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_album_card',
        'layout' => '<div class="grid grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6 gap-x-8 gap-y-12">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false,
        ],
    ]) ?>

</div>