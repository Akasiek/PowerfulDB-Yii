<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\AlbumGenre */
/* @var $form yii\widgets\ActiveForm */

$models = [
    'Genre' => \common\models\Genre::find()->asArray()->all(),
    'Album' => \common\models\Album::find()->asArray()->all(),
];

$maps = [
    'Genre' => ArrayHelper::map($models['Genre'], 'id', 'name'),
    'Album' => ArrayHelper::map($models['Album'], 'id', 'title'),
];
?>

<div class="album-genre-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'genre_id')->dropDownList($maps['Genre'], [
        'prompt' => 'Select a genre',
    ]) ?>

    <?= $form->field($model, 'album_id')->dropDownList($maps['Album'], [
        'prompt' => 'Select an album',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>