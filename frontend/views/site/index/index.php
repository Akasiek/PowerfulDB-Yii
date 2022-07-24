<?php

/**
 * @var yii\web\View $this
 * @var $artists ActiveDataProvider
 * @var $bands ActiveDataProvider
 * @var $albums ActiveDataProvider
 */

use ruturajmaniyar\widgets\toast\ToastrFlashMessage;
use yii\data\ActiveDataProvider;

$this->title = 'Home Page';
?>
<div>
    <?= $this->render('_jumbotron'); ?>

    <div class="py-8 px-6 md:px-8 lg:px-12 flex flex-col gap-20">

        <div>
            <h2 class="font-sans text-2xl md:text-3xl">Popular artists</h2>

            <hr class="section-hr">

            <?= $this->render('@frontend/views/components/_default_swiper', [
                'dataProvider' => $artists,
            ]); ?>
        </div>

        <div>
            <h2 class="font-sans text-2xl md:text-3xl">Popular bands</h2>

            <hr class="section-hr">

            <?= $this->render('@frontend/views/components/_default_swiper', [
                'dataProvider' => $bands,
            ]); ?>
        </div>

        <div>
            <h2 class="font-sans text-2xl md:text-3xl">Popular albums</h2>

            <hr class="section-hr">

            <?= $this->render('@frontend/views/album/_album_swiper', [
                'dataProvider' => $albums,
                'location' => 'index',
            ]) ?>
        </div>

        <?= $this->render('on_this_day/_on_this_day'); ?>

    </div>
</div>