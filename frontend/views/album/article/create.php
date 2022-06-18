<?php
/**
 * @var $model AlbumArticle
 * @var $slug string
 */

use common\models\AlbumArticle;
use dosamigos\tinymce\TinyMce;
use kartik\form\ActiveForm;

?>


<div class="py-14 px-20 max-w-screen-lg w-full m-auto flex justify-center items-center">
    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'w-full',
        ],

    ]) ?>

    <h1 class="text-5xl font-sans mb-6">Add an article</h1>

    <div class="flex flex-col gap-10 w-full">

        <!-- ARTICLE INPUT -->
        <?= $form->field($model, 'text')->widget(TinyMce::className(), [
            'language' => 'en_GB',
            'clientOptions' => [
                'plugins' => [
                    'image', 'emoticons', 'autolink', 'autoresize'
                ],
                'toolbar' => 'undo redo | styleselect blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons horizontalrule',
            ]
        ])->label(false) ?>

        <!-- SUBMIT BUTTON -->
        <div class="flex justify-end ">
            <input type="submit" value="Submit"
                   class="btn-style">
        </div>


    </div>

    <?php ActiveForm::end() ?>
</div>