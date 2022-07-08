<?php

/** 
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\widgets\ListView;
?>


<div class="px-14 py-8">

    <div class="mb-10">
        <h1 class="font-sans text-5xl ">Users list</h1>
        <hr class="border-t-2 border-main-accent mt-3">
    </div>

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
        'itemView' => '_user_card',
        'layout' => '<div class="grid grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6 gap-x-8 gap-y-12">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false,
        ],
    ]) ?>



</div>