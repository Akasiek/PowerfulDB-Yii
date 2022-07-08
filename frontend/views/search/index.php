<?php

/**
 * @var $artists ActiveDataProvider
 * @var $bands ActiveDataProvider
 * @var $albums ActiveDataProvider
 * @var $keyword string
 */

use yii\data\ActiveDataProvider;

?>
<div class="px-14 py-8">
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

                <?= $this->render('@frontend/views/components/_default_swiper', [
                    'dataProvider' => $artists,
                    'baseUrl' => 'artist',
                ]) ?>
            </div>
        <?php endif; ?>

        <?php if (count($bands->getModels()) > 0) : ?>
            <div class="">
                <h2 class="font-sans text-3xl">Found Bands</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <?= $this->render('@frontend/views/components/_default_swiper', [
                    'dataProvider' => $bands,
                    'baseUrl' => 'bands',
                ]) ?>
            </div>
        <?php endif; ?>

        <?php if (count($albums->getModels()) > 0) : ?>
            <div class="">
                <h2 class="font-sans text-3xl">Found Albums</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <?= $this->render('@frontend/views/album/_album_swiper', [
                    'dataProvider' => $albums,
                ]) ?>
            </div>
        <?php endif; ?>

        <?php if (count($users->getModels()) > 0) : ?>
            <div>
                <h2 class="font-sans text-3xl">Found Users</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <div class="swiper user-swiper w-full relative">
                    <div class="swiper-wrapper">
                        <?php foreach ($users->getModels() as $model) : ?>
                            <div class="swiper-slide select-none">
                                <?= $this->render('@frontend/views/user/_user_card', [
                                    'model' => $model,
                                ]) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="swiper-button-prev ml-2 !z-20 select-none">
                        <span class="material-symbols-outlined !text-6xl" style="text-shadow: 0 0 20px rgba(0,0,0,0.25)">navigate_before</span>
                    </div>
                    <div class="swiper-button-next mr-2 !z-20 select-none">
                        <span class="material-symbols-outlined !text-6xl ">navigate_next</span>
                    </div>

                    <div class="absolute top-0 bottom-0 right-0 w-36 z-10 rotate-180 pointer-events-none" style="background: linear-gradient(270deg, rgba(27, 28, 34, 0) 0%, #1B1C22 100%);"></div>
                </div>
            </div>
        <?php endif; ?>

    </div>


</div>