<?php

/**
 * @var $model Band
 */

use common\models\Band;
use kartik\form\ActiveForm;
use yii\web\View;

$this->registerJsFile('@web/js/showBgImage.js', ['position' => View::POS_HEAD]);

$this->title = "Create Band";
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="form-title mb-4 mb:mb-6">Add a band</h1>

    <div class="flex flex-col gap-6 md:gap-10 max-w-lg xl:max-w-2xl text-sm sm:text-base md:text-lg">

        <!-- NAME INPUT -->
        <?= $form->field($model, 'name', [
            'errorOptions' => ['class' => 'text-red-500'],
        ])->textInput(['maxlength' => 255, 'class' => 'input-style', 'placeholder' => 'Iron Maiden']) ?>


        <div class="grid grid-cols-2 gap-4 sm:gap-8 md:gap-10">

            <!-- FOUNDING YEAR INPUT -->
            <?= $form->field($model, 'founding_year', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('number', ['class' => 'input-style', 'placeholder' => '1975']) ?>

            <!-- BREAK-UP YEAR INPUT -->
            <?= $form->field($model, 'breakup_year', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('number', ['class' => 'input-style', 'placeholder' => '2010 (if broke up)']) ?>

        </div>

        <!-- BACKGROUND IMAGE URL INPUT -->
        <?= $form->field($model, 'bg_image_url', [
            'errorOptions' => ['class' => 'text-red-500'],
        ])->textInput(['maxlength' => 2048, 'class' => 'input-style', 'placeholder' => 'Url']) ?>

        <!-- BACKGROUND IMAGE PREVIEW -->
        <img src="<?= Yii::getAlias('@web/resources/images/no_image.jpg') ?>" id="user_image" class="w-full aspect-[315/175] object-cover object-center" alt="image uploaded by the user" />

        <!-- SUBMIT BUTTON -->
        <div class="text-right">
            <input type="submit" value="Submit" class="btn-style">
        </div>
    </div>

    <?php ActiveForm::end() ?>
</div>

<script>
    showBgImage('band-bg_image_url', 'user_image', '<?= Yii::getAlias('@web/resources/images/no_image.jpg') ?>');
</script>