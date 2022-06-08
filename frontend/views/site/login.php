<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var \common\models\LoginForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login flex flex-col justify-center items-center h-screen w-screen">
    <div class="px-14 py-10 bg-main-dark rounded-3xl">

        <h1 class="font-sans text-3xl"><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to login:</p>

        <div class="flex flex-col gap-6">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username', [
                'template' => '
                                <div class="flex flex-col">
                                    {label}
                                    {input}
                                    <span class="text-red-500">{error}</span>
                                </div>',
                'horizontalCssClasses' => [
                    'wrapper' => 'rounded-3xl bg-secondary-dark border-2 border-main-accent px-4 py-2
                        focus:outline-0 focus:shadow-accent transition duration-150
                        placeholder:text-gray-600',
                ],
            ])->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                <br>
                Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', [
                    'class' => 'px-4 py-2 bg-dark',
                    'name' => 'login-button'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
