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
    <div class="px-6 md:px-10 lg:px-14 py-6 md:py-10 bg-main-dark rounded-3xl max-w-lg m-4">

        <h1 class="font-sans text-2xl md:text-3xl mb-1"><?= Html::encode($this->title) ?></h1>

        <p class="text-sm md:text-base">Please fill out the following fields to login:</p>


        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="flex flex-col gap-3 sm:gap-4 md:gap-6
                    mt-3 sm:mt-4 md:mt-6 text-sm sm:text-base md:text-lg">

            <?= $form->field($model, 'username', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->textInput([
                'autofocus' => true,
                'class' => 'input-style',
            ]) ?>


            <?= $form->field($model, 'password', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->passwordInput([
                'class' => 'input-style',
            ]) ?>

            <?= $form->field($model, 'rememberMe', [])->checkbox([
                'class' => 'h-3 md:h-4 aspect-square',
            ]) ?>

            <div class="text-gray-400 flex flex-col gap-1 text-xs sm:text-sm md:text-base">
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