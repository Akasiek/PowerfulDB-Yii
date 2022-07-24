<?php
/**
 * @var $model Band
 * @var $form ActiveForm
 */

use common\models\Band;
use kartik\form\ActiveForm;

?>

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
])->textInput([
    'id' => 'image-url-input',
    'maxlength' => 2048,
    'class' => 'input-style',
    'placeholder' => 'Url'
]) ?>

<!-- BACKGROUND IMAGE PREVIEW -->
<img src="<?= Yii::getAlias('@web/resources/images/no_image.jpg') ?>" id="image-display"
     class="w-full aspect-[315/175] object-cover object-center" alt="image uploaded by the user"/>

<!-- SUBMIT BUTTON -->
<div class="text-right">
    <input type="submit" value="Submit" class="btn-style">
</div>
