<?php

/**
 * @var yii\web\View $this
 * @var kartik\form\ActiveForm $form
 * @var \frontend\models\PasswordResetRequestForm $model
 */

use yii\bootstrap4\Html;
use kartik\form\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flex flex-col justify-center items-center h-screen w-screen">
    <div class="px-6 md:px-10 lg:px-14 py-6 md:py-10 bg-main-dark rounded-3xl max-w-lg m-4">

        <h1 class="font-sans text-2xl md:text-3xl mb-1"><?= Html::encode($this->title) ?></h1>

        <p class="text-sm md:text-base">Please fill out your email. A link to reset password will be sent there.</p>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
        <div class="flex flex-col gap-3 sm:gap-4 md:gap-6
                    mt-3 sm:mt-4 md:mt-6 text-sm sm:text-base md:text-lg">


            <?= $form->field($model, 'email', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('email', [
                'autofocus' => true,
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