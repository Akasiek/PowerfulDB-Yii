<?php

/** 
 * @var $album Album
 */

use common\models\Album;
use common\models\Track;
use common\models\Artist;
use common\models\Band;
use kartik\form\ActiveForm;
use yii\web\View;

$this->title = 'Add Tracks';


$tracks = Yii::$app->request->get('tracks');
if (!isset($tracks)) $tracks = 10;

// Create an array of options for dropdown list for selecting artists and bands
$artists = Artist::find()
    ->select(['id', 'name'])->orderBy('name')->asArray()->all();
$bands = Band::find()
    ->select(['id', 'name'])->orderBy('name')->asArray()->all();

array_walk($artists, function (&$artist) {
    $artist['id'] = 'artist-' . $artist['id'];
});
array_walk($bands, function (&$band) {
    $band['id'] = 'band-' . $band['id'];
});
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex flex-col justify-center items-center">

    <h1 class="form-title mb-2 mb:mb-4 w-full max-w-lg xl:max-w-2xl">Add tracks to album <?= $album->title ?></h1>

    <div class="flex flex-col gap-6 md:gap-10 max-w-lg xl:max-w-2xl text-sm sm:text-base md:text-lg w-full">

        <form class="flex gap-2 sm:gap-4 items-center">
            <label for="tracks" class="text-sm md:text-base">How many tracks does this album have?</label>
            <input class="input-style w-16 text-center py-1" type="number" name="tracks" value="<?= $tracks ?>">
            <input type="submit" value="Save" class="btn-style py-1">
        </form>

        <?php $form = ActiveForm::begin() ?>
        <div class="flex flex-col gap-5">
            <?php for ($i = 1; $i <= $tracks; $i++) : ?>

                <div>
                    <div class="flex gap-2 sm:gap-4 items-center">
                        <input require name="tracks[<?= $i ?>]" class="input-style py-1 w-full" placeholder="<?= $i ?>.">
                        <input require name="tracks_duration[<?= $i ?>]" class="input-style py-1 w-48 md:w-56" type="time" step="1" value="00:00:00">
                    </div>
                    <div>
                        <button type="button" class="hover:text-main-accent hover:underline cursor-pointer featured-btn">
                            Add featured authors +
                        </button>
                        <div class="hidden mb-6 featured-select">
                            <select name="featured_author_id[<?= $i ?>]" class="input-style slim-select" multiple>
                                <option data-placeholder="true" value="">Select an author</option>

                                <optgroup label="Artists">
                                    <?php foreach ($artists as $artist) : ?>
                                        <option value="<?= $artist['id'] ?>"><?= $artist['name'] ?></option>
                                    <?php endforeach; ?>
                                </optgroup>

                                <optgroup label="Bands">
                                    <?php foreach ($bands as $band) : ?>
                                        <option value="<?= $band['id'] ?>"><?= $band['name'] ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
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