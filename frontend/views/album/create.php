<?php

/**
 * @var $model Album
 */

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use yii\web\View;
use kartik\form\ActiveForm;

$this->title = "Create Album";

// Check if there is a band or artist id parameter in the url
if (isset($_GET['band_id'])) {
    $paramBand = Band::find()->where(['id' => $_GET['band_id']])->one();
} elseif (isset($_GET['artist_id'])) {
    $paramArtist = Artist::find()->where(['id' => $_GET['artist_id']])->one();
}

?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="form-title mb-4 mb:mb-6">Add an album</h1>

    <div class="flex flex-col gap-6 md:gap-10 max-w-lg xl:max-w-2xl text-sm sm:text-base md:text-lg">

        <?= $this->render('_form', [
            'model' => $model,
            'form' => $form,
        ]) ?>


    </div>

    <?php ActiveForm::end() ?>
</div>
