<?php

use common\models\Artist;
use common\models\Band;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BandMember */
/* @var $form yii\widgets\ActiveForm */

$artists = Artist::find()->asArray()->all();
$artistsMap = ArrayHelper::map($artists, 'id', 'name');
$bands = Band::find()->asArray()->all();
$bandsMap = ArrayHelper::map($bands, 'id', 'name');
?>

<div class="band-member-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'artist_id')->dropDownList($artistsMap, [
        'prompt' => 'Select an artist',
    ]) ?>

    <?= $form->field($model, 'band_id')->dropDownList($bandsMap, [
        'prompt' => 'Select a band',
    ]) ?>

    <?= $form->field($model, 'join_year')->textInput() ?>

    <?= $form->field($model, 'quit_year')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
