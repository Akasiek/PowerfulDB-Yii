<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Album;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Track */
/* @var $form yii\widgets\ActiveForm */


$albumMap = ArrayHelper::map(Album::find()->asArray()->all(), 'id', 'title');
?>

<div class="track-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'album_id')->dropDownList($albumMap, [
        'prompt' => 'Select an album',
    ]) ?>

    <?= $form->field($model, 'duration')->input('time', ['step' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>