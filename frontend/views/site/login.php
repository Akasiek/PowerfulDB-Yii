<?php

/**
 * @var yii\web\View $this
 * @var kartik\form\ActiveForm $form
 * @var \common\models\LoginForm $model
 */

use yii\bootstrap4\Html;
use kartik\form\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flex flex-col justify-center items-center h-screen w-screen">
    <div class="px-14 py-10 bg-main-dark rounded-3xl w-[30rem]">

        <h1 class="font-sans text-3xl mb-1"><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to login:</p>


        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="flex flex-col gap-6 mt-6">

            <?= $form->field($model, 'username', [
                'labelOptions' => ['class' => 'text-lg'],
                'errorOptions' => ['class' => 'text-red-500'],
            ])->textInput([
                'autofocus' => true,
                'class' => 'input-style',
            ]) ?>


            <?= $form->field($model, 'password', [
                'labelOptions' => ['class' => 'text-lg'],
                'errorOptions' => ['class' => 'text-red-500'],
            ])->passwordInput([
                'class' => 'input-style',
            ]) ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="text-gray-400 flex flex-col gap-1">
                <p class="text-main-light">If you don't have an account
                    <?= Html::a(
                        'create it here',
                        ['site/signup'],
                        ['class' => 'text-main-accent hover:underline']
                    ) ?>.
                </p>
                <p>
                    If you forgot your password you can
                    <?= Html::a(
                        'reset it',
                        ['site/request-password-reset'],
                        ['class' => 'text-main-accent hover:underline']
                    ) ?>.
                </p>
                <p>
                    Need new verification email? <?= Html::a(
                        'Resend',
                        ['site/resend-verification-email'],
                        ['class' => 'text-main-accent hover:underline']
                    ) ?>
                </p>
            </div>

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
