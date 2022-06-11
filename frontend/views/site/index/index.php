<?php

/**
 * @var yii\web\View $this
 * @var $artists ActiveDataProvider
 */

use yii\data\ActiveDataProvider;

$this->title = 'My Yii Application';
?>
<div>
    <?php echo $this->render('_jumbotron'); ?>

    <div class="py-8 px-12">

        <div class="">
            <h2 class="font-sans text-3xl">Popular artists</h2>

            <hr class="border-t-2 border-main-accent w-96 mt-2 mb-8">

            <?php echo $this->render('@frontend/views/components/_default_swiper', ['dataProvider' => $artists]); ?>


        </div>
    </div>
</div>
