<?php

use common\models\Band;
use dosamigos\tinymce\TinyMce;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BandArticle */
/* @var $form yii\widgets\ActiveForm */

$bandModels = Band::find()->asArray()->all();
$bandMap = ArrayHelper::map($bandModels, 'id', 'name');
?>

<div class="band-article-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'band_id')->dropDownList($bandMap, [
        'prompt' => 'Select a band',
    ]) ?>

    <?= $form->field($model, 'text')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'en_GB',
        'clientOptions' => [
            'plugins' => [
                'image', 'emoticons', 'autolink', 'link'
            ],
            'toolbar' => 'undo redo | styleselect blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons | link',
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
