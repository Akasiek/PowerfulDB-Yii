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
        'itemView' => '_genre_view',
        'layout' => '<div class="flex flex-col gap-14">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false,
        ],
    ]) ?>
</div>