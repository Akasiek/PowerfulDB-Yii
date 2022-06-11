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

        <h1 class="font-sans text-3xl mb-1"><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to login:</p>


        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="flex flex-col gap-5 mt-6">

            <?= $form->field($model, 'username', [
                'template' => '<div class="text-lg mb-2">{label}</div>
                                {input}
                                <div class="text-red-500 mt-2">{error}</div>',
            ])->textInput(['autofocus' => true, 'class' => 'input-style']) ?>

            <?= $form->field($model, 'password', ['template' => '
            <div class="text-lg mb-2">{label}</div>
            {input}
            <div class="text-red-500 mt-2">{error}</div>'])->passwordInput(['class' => 'input-style']) ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="text-gray-400">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                <br>
                Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', [
                    'class' => 'px-5 py-1.5 border-2 border-main-accent rounded-3xl
                                hover:bg-main-accent hover:text-secondary-dark transition duration-200
                                font-bold',
                    'name' => 'login-button'
                ]) ?>
            </div>

        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
