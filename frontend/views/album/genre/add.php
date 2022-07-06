<?php

/** 
 * @var $model AlbumGenre
 * @var $album Album
 */

use common\models\Album;
use common\models\Genre;
use kartik\form\ActiveForm;
use yii\helpers\Url;

$genres = Genre::find()->all();
?>

<div class="py-14 px-20 mt-24 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="text-5xl font-sans mb-3 w-[30rem] xl:w-[40rem]">Add genres to album <?= $album->title ?></h1>

    <p class="mb-6">
        If you didn't found the appropriate genre try adding it
        <a href="<?= Url::to('/genre/create') ?>" class="text-main-accent hover:underline">in the genre create page</a>
    </p>


    <div class="flex flex-col gap-5 w-[30rem] xl:w-[40rem]">

        <div class="required">
            <label for="genres[]" class="text-2xl has-star">Choose genres</label>
            <select id="select-slim" name="genres[]" class="input-style" multiple>

                <?php foreach ($genres as $genre) : ?>
                    <option value="<?= $genre->id ?>"><?= $genre->name ?></option>
                <?php endforeach; ?>


            </select>

        </div>

        <div class="text-right">
            <input type="submit" value="Submit" class="btn-style">
        </div>

    </div>

    <?php ActiveForm::end() ?>
</div>