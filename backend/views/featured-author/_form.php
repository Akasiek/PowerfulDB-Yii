<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\FeaturedAuthor */
/* @var $form yii\widgets\ActiveForm */

$trackModel = \common\models\Track::find()->asArray()->all();
$artistModels = \common\models\Artist::find()->asArray()->all();
$bandModels = \common\models\Band::find()->asArray()->all();

$trackMap = ArrayHelper::map($trackModel, 'id', 'title');
$artistMap = ArrayHelper::map($artistModels, 'id', 'name');
$bandMap = ArrayHelper::map($bandModels, 'id', 'name');

?>

<div class="featured-author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'track_id')->dropDownList($trackMap, [
        'prompt' => 'Select a track',
    ]) ?>

    <?= $form->field($model, 'band_id')->dropDownList($bandMap, [
        'prompt' => 'Select a band',
    ]) ?>

    <?= $form->field($model, 'artist_id')->dropDownList($artistMap, [
        'prompt' => 'Select an artist',
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>