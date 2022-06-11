<?php
/**
 * @var $dataProvider ActiveDataProvider
 */

use yii\data\ActiveDataProvider;

?>

<div class="px-14 py-8">

    <div class="mb-10">
        <div class="flex items-center justify-between">
            <h1 class="font-sans text-5xl ">Artist list</h1>
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="flex">
                    <div class="py-2 pl-5 pr-3 bg-main-accent rounded-3xl text-secondary-dark font-bold">
                        <a href="<?php echo \yii\helpers\Url::to('/artist/create') ?>"
                           class="flex items-center justify-center gap-2">
                            Add Artist
                            <span class="material-symbols-outlined">
                        add
                    </span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <hr class="border-t-2 border-main-accent mt-3">

    </div>


    <?php echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
//    'pager' => [
//        'class' => \yii\bootstrap4\LinkPager::class,
//    ],
        'itemView' => '@frontend/views/components/_default_card',
        'layout' => '<div class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-12">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false,
        ],
    ]) ?>

</div>
