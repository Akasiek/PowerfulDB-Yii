<?php

/**
 * @var $model AlbumArticle | BandArticle
 */

use common\models\AlbumArticle;
use common\models\BandArticle;
use dosamigos\tinymce\TinyMce;
use kartik\form\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'w-full',
    ],

]) ?>

<h1 class="form-title mb-4 mb:mb-6">Add an article</h1>

<div class="flex flex-col gap-10 w-full">

    <!-- ARTICLE TEXT INPUT -->
    <?= $form->field($model, 'text')->widget(TinyMce::className(), [
        'language' => 'en_GB',
        'clientOptions' => [
            'plugins' => [
                'image', 'emoticons', 'autolink', 'autoresize', 'link'
            ],
            'toolbar' => 'undo redo | styleselect blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons',
        ]
    ])->label(false) ?>

    <!-- SUBMIT BUTTON -->
    <div class="flex justify-end ">
        <input type="submit" value="Submit" class="btn-style">
    </div>


</div>

<?php ActiveForm::end() ?>