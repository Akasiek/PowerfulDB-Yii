<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EditSubmission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="edit-submission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'table')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'column')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'element_id')->textInput() ?>

    <?= $form->field($model, 'old_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'new_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
