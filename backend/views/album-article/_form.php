<?php

use common\models\Album;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\AlbumArticle */
/* @var $form yii\widgets\ActiveForm */

$albumModels = Album::find()->asArray()->all();
$albumMap = ArrayHelper::map($albumModels, 'id', 'title');
?>

<div class="album-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'album_id')->dropDownList($albumMap, [
        'prompt' => 'Select an album',
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
