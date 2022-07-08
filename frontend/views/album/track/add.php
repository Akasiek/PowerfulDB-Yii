<?php

/** 
 * @var $album Album
 */

use common\models\Album;
use common\models\Track;
use kartik\form\ActiveForm;
use yii\helpers\Url;


$tracks = Yii::$app->request->get('tracks');
if (!isset($tracks)) $tracks = 10;
?>

<div class="py-14 px-20 w-full flex flex-col justify-center items-center">

    <h1 class="text-5xl font-sans mb-3 w-[30rem] xl:w-[40rem]">Add tracks to album <?= $album->title ?></h1>

    <div class="flex flex-col gap-5 w-[30rem] xl:w-[40rem]">

        <form class="flex gap-4 items-center">
            <label for="tracks">How many tracks does this album have?</label>
            <input class="input-style w-16 text-center py-1" type="number" name="tracks" value="<?= $tracks ?>">
            <input type="submit" value="Save" class="btn-style py-1">
        </form>

        <?php $form = ActiveForm::begin() ?>
        <div class="flex flex-col gap-5">
            <?php for ($i = 1; $i <= $tracks; $i++) : ?>

                <div>
                    <div class="flex gap-4 items-center">
                        <input require name="tracks[<?= $i ?>]" class="input-style py-1 w-full" placeholder="<?= $i ?>.">
                        <input require name="tracks-duration[<?= $i ?>]" class="input-style py-1 w-48" type="time" step="1" value="00:00:00">
                    </div>
                </div>

            <?php endfor; ?>
        </div>

        <div class="text-right mt-8">
            <input type="submit" value="Submit" class="btn-style">
        </div>
        <?php ActiveForm::end() ?>
    </div>

</div>