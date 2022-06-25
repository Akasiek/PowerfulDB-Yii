<?php

/**
 * @var $dataProvider ActiveDataProvider
 * @var $sort Sort
 */

use \yii\widgets\ListView;

?>

<div class="px-14 py-8">

    <?= $this->render('@frontend/views/components/_index_page_title') ?>

    <?= $this->render('_index_album_sort_filter', [
        'sort' => $sort,
    ]) ?>


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'options' => [
                'class' => 'my-8 flex rounded-lg bg-main-dark w-fit overflow-hidden',
            ],
            'linkOptions' => [
                'class' => 'flex justify-center items-center py-3 px-4',
            ],
            'pageCssClass' => 'flex hover:opacity-60',
            'disabledPageCssClass' => 'py-3 px-4 text-gray-500',
            'activePageCssClass' => 'bg-secondary-accent',
            'maxButtonCount' => 6,
        ],
        'itemView' => '_album_card',
        'layout' => '<div class="grid grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6 gap-x-8 gap-y-12">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false,
        ],
    ]) ?>



</div>