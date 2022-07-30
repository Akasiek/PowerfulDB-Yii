<?php
/**
 * @var $model BandMember
 * @var $band Band
 */

use common\models\Band;
use common\models\BandMember;
use kartik\form\ActiveForm;

$this->title = 'Edit member';
?>


<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="form-title mb-6 md:mb-10">Edit member <?= $model->artist->name ?? $model->name ?></h1>

    <div class="flex flex-col gap-6 md:gap-10 max-w-lg xl:max-w-2xl text-sm sm:text-base md:text-lg">

        <div class="grid grid-cols-2 gap-4 sm:gap-8 md:gap-10">

            <!-- JOIN YEAR INPUT -->
            <?= $form->field($model, 'join_year', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('number', ['class' => 'input-style', 'placeholder' => '1975']) ?>

            <!-- QUIT YEAR INPUT -->
            <?= $form->field($model, 'quit_year', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('number', ['class' => 'input-style', 'placeholder' => '2010'])
                ->label('Quit year (if quit)') ?>

        </div>

        <!-- ROLE INPUT -->
        <?= $form->field($model, 'roles', [
            'errorOptions' => ['class' => 'text-red-500'],
        ])
            ->textInput(['maxlength' => 255, 'class' => 'input-style', 'placeholder' => 'vocals, guitar, bass...'])
        ?>

        <!-- BUTTONS -->
        <div class="flex justify-between">
            <?= \yii\helpers\Html::a('Delete', [
                '/band/member-delete',
                'bandSlug' => $band->slug,
                'memberId' => $model->id,
            ], [
                'class' => 'btn-style-warning'
            ]) ?>
            <input type="submit" value="Submit" class="ml-auto btn-style">
        </div>

    </div>

    <?php ActiveForm::end() ?>
</div>