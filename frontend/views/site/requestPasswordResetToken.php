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
    <div class="px-14 py-10 bg-main-dark rounded-3xl w-[30rem]">

        <h1 class="font-sans text-3xl mb-1"><?= Html::encode($this->title) ?></h1>

        <p>Please fill out your email. A link to reset password will be sent there.</p>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
        <div class="flex flex-col gap-6 mt-6">


            <?= $form->field($model, 'email', [
                'labelOptions' => ['class' => 'text-lg'],
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
