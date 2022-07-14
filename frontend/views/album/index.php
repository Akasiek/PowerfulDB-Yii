<?php

/**
 * @var $dataProvider ActiveDataProvider
 * @var $sort Sort
 */

use \yii\widgets\ListView;

$this->title = "Albums";

$release_from_year = Yii::$app->request->get('release_from_year');
$release_to_year = Yii::$app->request->get('release_to_year');
$genre = Yii::$app->request->get('genre');
?>

<div class="px-6 lg:px-14 py-8">

    <?= $this->render('@frontend/views/components/_index_page_title') ?>

    <?= $this->render('@frontend/views/components/_filter_sort_main.php', [
        'hasGenreFilter' => true,
        'genre' => $genre,
        'yearFilters' => [
            'release' => [
                'label' => 'Release year',
                'from_year' => $release_from_year,
                'to_year' => $release_to_year,
            ],

        ],
        'sort' => $sort,
        'sortOptions' => [
            '-popularity' => 'By popularity',
            'title' => 'Title Ascending',
            '-title' => 'Title Descending',
            'release_date' => 'Oldest First',
            '-release_date' => 'Newest First',
        ]
    ]) ?>


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'options' => [
                'class' => 'my-8 mx-auto flex rounded-lg bg-main-dark w-fit overflow-hidden',
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
        'layout' => '<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6
        gap-x-4 md:gap-x-8 gap-y-8 md:gap-y-12">{items}</div>{pager}',
    ]) ?>



</div>