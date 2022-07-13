<?php

/** 
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\widgets\ListView;

$this->title = "Users";
?>


<div class="px-6 md:px-10 lg:px-14 py-8">

    <div class="mb-6">
        <h1 class="section-title">Users list</h1>
        <hr class="section-hr">
    </div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'options' => [
                'class' => 'my-8 flex rounded-lg bg-main-dark w-fit overflow-hidden mx-auto',
            ],
            'linkOptions' => [
                'class' => 'flex justify-center items-center py-3 px-4',
            ],
            'pageCssClass' => 'flex hover:opacity-60',
            'disabledPageCssClass' => 'py-3 px-4 text-gray-500',
            'activePageCssClass' => 'bg-secondary-accent',
            'maxButtonCount' => 6,
        ],
        'itemView' => '_user_card',
        'layout' => '<div class="grid grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6
                                gap-x-4 md:gap-x-6 lg:gap-x-8 gap-y-8 md:gap-y-10 lg:gap-y-12">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false,
        ],
    ]) ?>



</div>