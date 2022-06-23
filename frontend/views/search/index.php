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
    <?php if ($artists->count == 0 && $bands->count == 0 && $albums->count == 0): ?>
        <p class="mt-8">No results found for "<?= $keyword ?>".
            <?= \yii\helpers\Html::a(' Go back to home page', ['/'], [
                'class' => 'text-main-accent hover:underline',
            ]) ?></p>
    <?php endif; ?>

    <div class="flex flex-col gap-16 mt-16">
        <?php if (count($artists->getModels()) > 0): ?>
            <div>
                <h2 class="font-sans text-3xl">Found Artists</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <?= $this->render('@frontend/views/components/_default_swiper', [
                    'dataProvider' => $artists,
                    'baseUrl' => 'artist',
                ]) ?>
            </div>
        <?php endif; ?>

        <?php if (count($bands->getModels()) > 0): ?>
            <div class="">
                <h2 class="font-sans text-3xl">Found Bands</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <?= $this->render('@frontend/views/components/_default_swiper', [
                    'dataProvider' => $bands,
                    'baseUrl' => 'bands',
                ]) ?>
            </div>
        <?php endif; ?>

        <?php if (count($albums->getModels()) > 0): ?>
            <div class="">
                <h2 class="font-sans text-3xl">Found Albums</h2>

                <hr class="border-t-2 border-t-secondary-accent w-64 mt-1 mb-6">

                <?= $this->render('@frontend/views/album/_album_swiper', [
                    'dataProvider' => $albums,
                ]) ?>
            </div>
        <?php endif; ?>

    </div>


</div>
