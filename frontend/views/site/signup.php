<?php

/**
 * @var yii\web\View $this
 * @var kartik\form\ActiveForm $form
 * @var \frontend\models\SignupForm $model
 */

use yii\bootstrap4\Html;
use kartik\form\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="flex flex-col justify-center items-center h-screen w-screen">
    <div class="px-14 py-10 bg-main-dark rounded-3xl w-[30rem]">

        <h1 class="font-sans text-3xl mb-1"><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to signup:</p>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="flex flex-col gap-6 mt-6">

            <?= $form->field($model, 'username', [
                'labelOptions' => ['class' => 'text-lg'],
                'errorOptions' => ['class' => 'text-red-500'],
            ])->textInput([
                'autofocus' => true,
                'class' => 'input-style',
            ]) ?>

            <div>
                <?= $form->field($model, 'email', [
                    'labelOptions' => ['class' => 'text-lg'],
                    'errorOptions' => ['class' => 'text-red-500'],
                ])->input('email', [
                    'class' => 'input-style',
                ]) ?>

                <p class="text-gray-400 text-sm">
                    Please use real email address. We will send verification mail to it.
                </p>
            </div>

            <?= $form->field($model, 'password', [
                'labelOptions' => ['class' => 'text-lg'],
                'errorOptions' => ['class' => 'text-red-500'],
            ])->passwordInput([
                'class' => 'input-style',
            ]) ?>

            <div class="flex justify-end">
                <?= Html::submitButton('Login', [
                    'class' => 'btn-style',
                    'name' => 'login-button'
                ]) ?>
            </div>

        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>

