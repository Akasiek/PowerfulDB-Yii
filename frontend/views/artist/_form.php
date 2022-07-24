<?php
/**
 * @var $model Artist
 * @var $form ActiveForm
 */

use common\models\Artist;
use kartik\form\ActiveForm;

?>

<!-- NAME INPUT -->
<?= $form->field($model, 'name', [
    'errorOptions' => ['class' => 'text-red-500'],
])->textInput([
    'maxlength' => 255,
    'class' => 'input-style',
    'placeholder' => 'Jack White'
]) ?>

<!-- FULL NAME INPUT -->
<?= $form->field($model, 'full_name', [
    'errorOptions' => ['class' => 'text-red-500'],
])->textInput([
    'maxlength' => 255,
    'class' => 'input-style',
    'placeholder' => 'John Anthony White (provide if different)',
]) ?>

<div class="grid grid-cols-2 gap-4 sm:gap-8 md:gap-10">

    <!-- BIRTH DATE INPUT -->
    <?= $form->field($model, 'birth_date', [
        'errorOptions' => ['class' => 'text-red-500'],
    ])->input('date', ['class' => 'input-style']) ?>

    <!-- DEATH DATE INPUT -->
    <?= $form->field($model, 'death_date', [
        'errorOptions' => ['class' => 'text-red-500'],
    ])->input('date', ['class' => 'input-style']) ?>

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
<img src="<?php echo Yii::getAlias('@web/resources/images/no_image.jpg') ?>" id="image-display"
     class="w-full aspect-[315/175] object-cover object-center" alt="image uploaded by the user"/>

<!-- SUBMIT BUTTON -->
<div class="text-right">
    <input type="submit" value="Submit" class="btn-style">
</div>