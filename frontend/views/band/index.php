<?php

/**
 * @var $dataProvider ActiveDataProvider
 * @var $sort Sort
 */

use yii\bootstrap4\LinkPager;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\widgets\ListView;

$founding_from_year = Yii::$app->request->get('founding_from_year');
$founding_to_year = Yii::$app->request->get('founding_to_year');
$break_up_from_year = Yii::$app->request->get('break_up_from_year');
$break_up_to_year = Yii::$app->request->get('break_up_to_year');
$genre = Yii::$app->request->get('genre');

$this->title = 'Bands';
?>
<div class="px-6 lg:px-14 py-8">

    <?= $this->render('@frontend/views/components/_index_page_title') ?>

    <?= $this->render('@frontend/views/components/_filter_sort_main.php', [
        'hasGenreFilter' => true,
        'genre' => $genre,
        'yearFilters' => [
            'founding' => [
                'label' => 'Founding year',
                'from_year' => $founding_from_year,
                'to_year' => $founding_to_year,
            ],
            'break_up' => [
                'label' => 'Break up year',
                'from_year' => $break_up_from_year,
                'to_year' => $break_up_to_year,
            ],

        ],
        'sort' => $sort,
        'sortOptions' => [
            '-popularity' => 'By popularity',
            'name' => 'Name Ascending',
            '-name' => 'Name Descending',
            'founding_year' => 'Created Last',
            '-founding_year' => 'Created First',
        ]
    ]) ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'options' => [
                'class' => 'my-12 mx-auto flex rounded-lg bg-main-dark w-fit overflow-hidden',
            ],
            'linkOptions' => [
                'class' => 'flex justify-center items-center py-3 px-4',
            ],
            'pageCssClass' => 'flex hover:opacity-60',
            'disabledPageCssClass' => 'py-3 px-4 text-gray-500',
            'activePageCssClass' => 'bg-secondary-accent',
            'maxButtonCount' => 6,
        ],
        'itemView' => '@frontend/views/components/_default_card',
        'layout' => '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 
        gap-x-4 gap-y-6 xl:gap-x-6 xl:gap-y-10 2xl:gap-y-16">{items}</div>{pager}',
    ]) ?>
</div>