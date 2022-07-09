<?php

/**
 * @var yii\web\View $this
 * @var $artists ActiveDataProvider
 * @var $bands ActiveDataProvider
 */

use ruturajmaniyar\widgets\toast\ToastrFlashMessage;
use yii\data\ActiveDataProvider;

$this->title = 'My Yii Application';
?>
<div>
    <?php echo $this->render('_jumbotron'); ?>

    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <?= ToastrFlashMessage::widget([
            'type' => 'success',
            'title' => 'Success',
            'message' => Yii::$app->session->getFlash('success')
        ]); ?>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')) : ?>
        <?= ToastrFlashMessage::widget([
            'type' => 'error',
            'title' => 'Error',
            'message' => Yii::$app->session->getFlash('error')
        ]); ?>
    <?php endif; ?>

    <div class="py-8 px-6 md:px-8 lg:px-12 flex flex-col gap-20">

        <div>
            <h2 class="font-sans text-3xl">Popular artists</h2>

            <hr class="border-t-2 border-main-accent max-w-sm mt-2 mb-8">

            <?php echo $this->render('@frontend/views/components/_default_swiper', [
                'dataProvider' => $artists,
                'baseUrl' => 'artist'
            ]); ?>
        </div>

        <div>
            <h2 class="font-sans text-3xl">Popular bands</h2>

            <hr class="border-t-2 border-main-accent max-w-sm mt-2 mb-8">

            <?php echo $this->render('@frontend/views/components/_default_swiper', [
                'dataProvider' => $bands,
                'baseUrl' => 'band'
            ]); ?>
        </div>

        <?php echo $this->render('on_this_day/_on_this_day'); ?>

    </div>
</div>