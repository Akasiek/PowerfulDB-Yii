<?php
/**
 * @var $model Artist
 */

use common\models\Artist;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

?>

<div class="py-14 px-20 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="text-5xl font-sans mb-2">Add an artist</h1>

    <div class="flex flex-col gap-10 w-[30rem] xl:w-[40rem]">


        <p><b class="text-red-500">Warning:</b> Artist can be <b>only</b> a solo artist or a member of a
            band. If you want to add a <b>band</b> go
            <a class="text-main-accent hover:underline"
               href="<?php echo Url::to('/band/create') ?>">here</a>
        </p>

        <!-- NAME INPUT -->
        <?= $form->field($model, 'name', ['template' =>
            '<div class="text-2xl mb-5">{label}</div>
            {input}
            <div class="text-red-500 mt-2">{error}</div>'])
            ->textInput(['maxlength' => 255, 'class' => 'input-style', 'placeholder' => 'Jack White']) ?>

        <!-- FULL NAME INPUT -->
        <?= $form->field($model, 'full_name', ['template' =>
            '<div class="text-2xl mb-5">{label}</div>
            {input}
            <div class="text-red-500 mt-2">{error}</div>'])
            ->textInput(['maxlength' => 255, 'class' => 'input-style', 'placeholder' => 'John Anthony White']) ?>


        <div class="grid grid-cols-2 gap-10">

            <!-- BIRTH DATE INPUT -->
            <?= $form->field($model, 'birth_date', ['template' =>
                '<div class="text-2xl mb-5">{label}</div>
            {input}
            <div class="text-red-500 mt-2">{error}</div>'])
                ->input('date', ['class' => 'input-style']) ?>

            <!-- DEATH DATE INPUT -->
            <?= $form->field($model, 'death_date', ['template' =>
                '<div class="text-2xl mb-5">{label}</div>
            {input}
            <div class="text-red-500 mt-2">{error}</div>'])
                ->input('date', ['class' => 'input-style']) ?>

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
    const bgImgUrl = document.getElementById('artist-bg_image_url');
    const userImg = document.getElementById('user_image');

    bgImgUrl.addEventListener('input', (e) => {
        const url = e.target.value;
        if (isImage(url)) userImg.src = url;
        else userImg.src = '<?php echo Yii::getAlias('@web/resources/images/no_image.jpg') ?>';
    });
</script>
