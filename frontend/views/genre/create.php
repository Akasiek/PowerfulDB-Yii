<?php

/** 
 * @var $model Genre
 */

use common\models\Genre;
use kartik\form\ActiveForm;

?>

<div class="py-14 px-20 mt-24 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="text-5xl font-sans mb-6">Add a genre</h1>

    <div class="flex flex-col gap-10 w-[30rem] xl:w-[40rem]">

        <!-- NAME INPUT -->
        <?= $form->field($model, 'name', [
            'labelOptions' => ['class' => 'text-2xl'],
            'errorOptions' => ['class' => 'text-red-500'],
        ])->textInput([
            'maxlength' => 255,
            'class' => 'input-style',
            'placeholder' => 'Progressive Rock',
            'autoFocus' => true,
        ]) ?>

        <!-- SUBMIT BUTTON -->
        <div class="text-right">
            <input type="submit" value="Submit" class="btn-style">
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>