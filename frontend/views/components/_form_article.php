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
                'toolbar_sticky' => true,
                'plugins' => [
                    'image', 'emoticons', 'autolink', 'autoresize', 'link'
                ],
                'toolbar' => 'undo redo | styleselect blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons',
            ]
        ])->label(false) ?>

        <div class="flex flex-col gap-10 max-w-2xl w-full mx-auto">
            <!-- SOURCE INPUT -->
            <?= $form->field($model, 'source', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->textInput([
                'maxlength' => true,
                'class' => 'input-style',
                'placeholder' => 'Wikipedia'
            ]) ?>


            <!-- SOURCE URL INPUT -->
            <?= $form->field($model, 'source_url', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->textInput([
                'maxlength' => true,
                'class' => 'input-style',
                'placeholder' => 'https://wikipedia.com'
            ]) ?>

            <!-- SUBMIT BUTTON -->
            <div class="flex justify-end ">
                <input type="submit" value="Submit" class="btn-style">
            </div>
        </div>
    </div>
<?php ActiveForm::end() ?>