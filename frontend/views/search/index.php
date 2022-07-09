<?php

/**
 * @var $artists ActiveDataProvider
 * @var $bands ActiveDataProvider
 * @var $albums ActiveDataProvider
 * @var $keyword string
 */

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

?>
<div class="px-6 md:px-14 py-8">
    <div>
        <h1 class="font-sans text-5xl ">Search results</h1>
        <hr class="border-t-2 border-main-accent mt-3">
    </div>

    <!--    display message if no results found-->
    <?php if ($artists->count == 0 && $bands->count == 0 && $albums->count == 0 && $users->count == 0) : ?>
        <p class="mt-8">No results found for "<?= $keyword ?>".
            <?= \yii\helpers\Html::a(' Go back to home page', ['/'], [
                'class' => 'text-main-accent hover:underline',
            ]) ?></p>
    <?php endif; ?>

    <div class="flex flex-col gap-16 mt-16">
        <?php if (count($artists->getModels()) > 0) : ?>
            <div>
                <h2 class="font-sans text-3xl">Found Artists</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <?= ListView::widget([
                    'dataProvider' => $artists,
                    'itemView' => '@frontend/views/components/_default_card',
                    'summary' => '',
                    'options' => [
                        'class' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 
                        gap-x-4 gap-y-6 xl:gap-x-8 xl:gap-y-12 2xl:gap-x-12 2xl:gap-y-16',
                    ],
                ]) ?>
            </div>
        <?php endif; ?>

        <?php if (count($bands->getModels()) > 0) : ?>
            <div class="">
                <h2 class="font-sans text-3xl">Found Bands</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <?= ListView::widget([
                    'dataProvider' => $bands,
                    'itemView' => '@frontend/views/components/_default_card',
                    'summary' => '',
                    'options' => [
                        'class' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 
                        gap-x-4 gap-y-6 xl:gap-x-8 xl:gap-y-12 2xl:gap-x-12 2xl:gap-y-16',
                    ],
                ]) ?>
            </div>
        <?php endif; ?>

        <?php if (count($albums->getModels()) > 0) : ?>
            <div class="">
                <h2 class="font-sans text-3xl">Found Albums</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <?= ListView::widget([
                    'dataProvider' => $albums,
                    'itemView' => '@frontend/views/album/_album_card',
                    'summary' => '',
                    'options' => [
                        'class' => 'grid grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6 gap-x-8 gap-y-12',
                    ],
                ]) ?>
            </div>
        <?php endif; ?>

        <?php if (count($users->getModels()) > 0) : ?>
            <div>
                <h2 class="font-sans text-3xl">Found Users</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <?= ListView::widget([
                    'dataProvider' => $users,
                    'itemView' => '@frontend/views/user/_user_card',
                    'summary' => '',
                    'options' => [
                        'class' => 'grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5
                        gap-x-4 gap-y-6 xl:gap-x-8 xl:gap-y-12 2xl:gap-x-12 2xl:gap-y-16',
                    ],
                ]) ?>
            </div>
        <?php endif; ?>

    </div>


</div>