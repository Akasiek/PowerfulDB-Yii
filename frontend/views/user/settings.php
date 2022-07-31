<?php
/**
 * @var $model User
 */

use common\models\User;
use kartik\form\ActiveForm;

$this->title = "User Settings";
?>


<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 max-w-4xl w-full mx-auto">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="form-title mb-4 mb:mb-6">User Settings</h1>

    <div class="flex flex-col gap-6 md:gap-10 w-full text-sm sm:text-base md:text-lg">

        <?= $form->field($model, 'profile_pic_url')
            ->textInput(['maxlength' => true, 'class' => 'input-style'])
            ->label('Profile Picture Url') ?>

        <?= $form->field($model, 'about_text')->textarea(['class' => 'input-style', 'rows' => 6]) ?>

        <!-- SUBMIT BUTTON -->
        <div class="text-right">
            <input type="submit" value="Submit" class="btn-style">
        </div>
        
    </div>

    <?php ActiveForm::end() ?>
</div>
