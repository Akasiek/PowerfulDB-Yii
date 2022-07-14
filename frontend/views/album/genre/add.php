<?php

/** 
 * @var $model AlbumGenre
 * @var $album Album
 */

use common\models\Album;
use common\models\Genre;
use kartik\form\ActiveForm;
use yii\helpers\Url;

$this->title = 'Add Genre';

$genres = Genre::find()->all();
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="form-title mb-2 mb:mb-4">Add genres to album <?= $album->title ?></h1>




    <div class="flex flex-col gap-6 md:gap-10 max-w-lg xl:max-w-2xl text-sm sm:text-base md:text-lg">

        <p class="text-xs sm:text-sm md:text-base">
            If you didn't found the appropriate genre try adding it
            <a href="<?= Url::to('/genre/create') ?>" class="text-main-accent hover:underline">in the genre create page</a>
        </p>

        <div class="required">
            <label for="genres[]" class="has-star">Choose genres</label>
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