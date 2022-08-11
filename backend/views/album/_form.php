<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Album */
/* @var $form yii\widgets\ActiveForm */

$artistModels = \common\models\Artist::find()->asArray()->all();
$bandModels = \common\models\Band::find()->asArray()->all();

$artistMap = \yii\helpers\ArrayHelper::map($artistModels, 'id', 'name');
$bandMap = \yii\helpers\ArrayHelper::map($bandModels, 'id', 'name');

?>

<div class="album-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'band_id')->dropDownList($bandMap, [
        'prompt' => 'Select a band',
    ]) ?>

    <?= $form->field($model, 'artist_id')->dropDownList($artistMap, [
        'prompt' => 'Select an artist',
    ]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        'LP' => 'LP',
        'EP' => 'EP',
        'Single' => 'Single',
        'Compilation' => 'Compilation',
        'Live Album' => 'Live Album',
        'Other' => 'Other',
    ], [
        'prompt' => 'Select type of album',
    ]) ?>

    <?= $form->field($model, 'release_date')->input('date') ?>

    <?= $form->field($model, 'artwork_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>