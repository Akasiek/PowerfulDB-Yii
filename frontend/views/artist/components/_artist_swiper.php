<?php
/**
 * @var $dataProvider ActiveDataProvider
 */

use yii\data\ActiveDataProvider;

?>

<div class="swiper w-full relative">
    <div class="swiper-wrapper">
        <?php foreach ($dataProvider->getModels() as $model): ?>
            <div class="swiper-slide select-none">
                <?php echo $this->render('_artist_card', ['model' => $model]); ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="swiper-button-prev ml-2 !z-20 select-none">
        <span class="material-symbols-outlined !text-6xl"
              style="text-shadow: 0 0 20px rgba(0,0,0,0.25)">navigate_before</span>
    </div>
    <div class="swiper-button-next mr-2 !z-20 select-none">
        <span class="material-symbols-outlined !text-6xl ">navigate_next</span>
    </div>

    <div class="absolute top-0 bottom-0 right-0 w-36 z-10 rotate-180 pointer-events-none"
         style="background: linear-gradient(270deg, rgba(27, 28, 34, 0) 0%, #1B1C22 100%);"></div>
</div>