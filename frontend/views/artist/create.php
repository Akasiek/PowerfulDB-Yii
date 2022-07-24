<?php

/**
 * @var $model Artist
 */

use common\models\Artist;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\web\View;

$this->title = "Create Artist";
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_VERTICAL,
    ]) ?>

    <h1 class="form-title mb-2">Add an artist</h1>

    <div class="flex flex-col gap-6 md:gap-10 max-w-lg xl:max-w-2xl text-sm sm:text-base md:text-lg">

        <p class="text-xs sm:text-sm md:text-base"><b class="text-red-500">Warning:</b> Artist can be <b>only</b> a solo
            artist or a member of a
            band. If you want to add a <b>band</b> go
            <a class="text-main-accent hover:underline" href="<?php echo Url::to('/band/create') ?>">here</a>
        </p>

        <?= $this->render('_form', [
            'model' => $model,
            'form' => $form,
        ]) ?>

    </div>


    <?php ActiveForm::end() ?>
</div>

<script>
    showBgImage('artist-bg_image_url', 'user_image', '<?php echo Yii::getAlias('@web/resources/images/no_image.jpg') ?>');
</script>