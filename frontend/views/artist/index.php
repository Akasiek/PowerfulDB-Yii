<?php
/**
 * @var $dataProvider ActiveDataProvider
 */

use yii\data\ActiveDataProvider;

?>

<div class="px-14 py-8">

    <h1 class="font-sans text-5xl pb-5">Artist list</h1>

    <?php echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
//    'pager' => [
//        'class' => \yii\bootstrap4\LinkPager::class,
//    ],
        'itemView' => '_artist_card',
        'layout' => '<div class="flex flex-wrap gap-6">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false,
        ],
    ]) ?>

</div>