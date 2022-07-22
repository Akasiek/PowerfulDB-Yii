<?php

use common\models\Artist;
use dosamigos\tinymce\TinyMce;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArtistArticle */
/* @var $form yii\widgets\ActiveForm */

$artistModels = Artist::find()->asArray()->all();
$artistMap = ArrayHelper::map($artistModels, 'id', 'name');
?>

<div class="artist-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'artist_id')->dropDownList($artistMap, [
        'prompt' => 'Select an artist',
    ]) ?>

    <?= $form->field($model, 'text')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'en_GB',
        'clientOptions' => [
            'plugins' => [
                'image', 'emoticons', 'autolink'
            ],
            'toolbar' => 'undo redo | styleselect blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons',
        ]
    ]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
