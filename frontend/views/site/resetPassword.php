<?php

/**
 * @var yii\web\View $this
 * @var kartik\form\ActiveForm $form
 * @var \frontend\models\ResetPasswordForm $model
 */

use yii\bootstrap4\Html;
use kartik\form\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flex flex-col justify-center items-center h-screen w-screen">
    <div class="px-14 py-10 bg-main-dark rounded-3xl w-[30rem]">

        <h1 class="font-sans text-3xl mb-1"><?= Html::encode($this->title) ?></h1>

        <p>Please choose your new password:</p>

        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
        <div class="flex flex-col gap-8 mt-6">

            <?= $form->field($model, 'password', [
                'labelOptions' => ['class' => 'text-lg'],
                'errorOptions' => ['class' => 'text-red-500'],
            ])->passwordInput([
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
