<?php

/**
 * @var $dataProvider ActiveDataProvider
 */

use yii\data\ActiveDataProvider;
use \yii\widgets\ListView;

?>

<div class="px-14 py-8">
    <?= $this->render('@frontend/views/components/_index_page_title') ?>

    <?= $this->render('_index_genre_filter') ?>

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
        'itemView' => '_genre_view',
        'layout' => '<div class="flex flex-col gap-14">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false,
        ],
    ]) ?>
</div>