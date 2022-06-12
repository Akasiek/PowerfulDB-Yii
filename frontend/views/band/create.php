<?php
/**
 * @var $model Band
 */

use common\models\Band;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

$this->registerJsFile('@web/js/showBgImage.js', ['position' => View::POS_HEAD]);

?>

<div class="py-14 px-20 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="text-5xl font-sans mb-6">Add a band</h1>

    <div class="flex flex-col gap-10 w-[30rem] xl:w-[40rem]">

        <!-- NAME INPUT -->
        <?= $form->field($model, 'name', ['template' =>
            '<div class="text-2xl mb-5">{label}</div>
            {input}
            <div class="text-red-500 mt-2">{error}</div>'])
            ->textInput(['maxlength' => 255, 'class' => 'input-style', 'placeholder' => 'Iron Maiden']) ?>


        <div class="grid grid-cols-2 gap-10">

            <!-- FOUNDING YEAR INPUT -->
            <?= $form->field($model, 'founding_year', ['template' =>
                '<div class="text-2xl mb-5">{label}</div>
            {input}
            <div class="text-red-500 mt-2">{error}</div>'])
                ->input('number', ['class' => 'input-style', 'placeholder' => '1975']) ?>

            <!-- BREAK-UP YEAR INPUT -->
            <?= $form->field($model, 'breakup_year', ['template' =>
                '<div class="text-2xl mb-5">{label}</div>
            {input}
            <div class="text-red-500 mt-2">{error}</div>'])
                ->input('number', ['class' => 'input-style', 'placeholder' => '2010 (if broken)']) ?>

        </div>

        <!-- BACKGROUND IMAGE URL INPUT -->
        <?= $form->field($model, 'bg_image_url', ['template' =>
            '<div class="text-2xl mb-5">{label}</div>
            {input}
            <div class="text-red-500 mt-2">{error}</div>'])
            ->textInput(['maxlength' => 2048, 'class' => 'input-style', 'placeholder' => 'Url']) ?>

        <!-- BACKGROUND IMAGE PREVIEW -->
        <img src="<?php echo Yii::getAlias('@web/resources/images/no_image.jpg') ?>" id="user_image"
             class="w-full aspect-[315/175] object-cover object-center" alt="image uploaded by the user"/>

        <!-- SUBMIT BUTTON -->
        <div class="text-right">
            <input type="submit" value="Submit"
                   class="bg-main-accent py-2 px-5 rounded-3xl text-secondary-dark font-bold cursor-pointer ">
        </div>
    </div>

    <?php echo $form->errorSummary($model) ?>

    <?php ActiveForm::end() ?>
</div>

<script>
    showBgImage('band-bg_image_url', 'user_image', '<?php echo Yii::getAlias('@web/resources/images/no_image.jpg') ?>');
</script>