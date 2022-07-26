<?php
/**
 * @var $model Track
 * @var $album Album
 */

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use common\models\Track;
use kartik\form\ActiveForm;

$this->title = 'Edit Track ' . $model->title;

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

$featuredAuthors = [];
foreach ($model->getFeaturedAuthors()->all() as $author) {
    if ($author->artist) {
        $featuredAuthors[] = 'artist-' . $author->artist_id;
    } else {
        $featuredAuthors[] = 'band-' . $author->band_id;
    }
}
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 max-w-lg lg:max-w-3xl mx-auto w-full">

    <h1 class="form-title mb-6 mb:mb-10 w-full">Edit track <?= $model->title ?></h1>

    <?php $form = ActiveForm::begin() ?>
    <div class="flex flex-col gap-6 md:gap-10 text-sm sm:text-base md:text-lg w-full">

        <?= $form->field($model, 'title', [
            'errorOptions' => ['class' => 'text-red-500'],
        ])->textInput([
            'maxlength' => true,
            'class' => 'input-style',
        ]) ?>

        <?= $form->field($model, 'position', [
            'errorOptions' => ['class' => 'text-red-500'],
        ])->input('number', [
            'class' => 'input-style',
        ]) ?>

        <?= $form->field($model, 'duration'
        )->input('time', [
            'step' => 1,
            'class' => 'input-style',
        ]) ?>

        <label>
            Featured authors
            <select name="featured_author[]" class="input-style slim-select" multiple>
                <option data-placeholder="true" value="">Select an author</option>

                <optgroup label="Artists">
                    <?php foreach ($artists as $artist) : ?>
                        <option value="<?= $artist['id'] ?>"
                            <?php if (in_array($artist['id'], $featuredAuthors)) echo 'selected' ?>>
                            <?= $artist['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </optgroup>

                <optgroup label="Bands">
                    <?php foreach ($bands as $band) : ?>
                        <option value="<?= $band['id'] ?>"
                            <?php if (in_array($artist['id'], $featuredAuthors)) echo 'selected' ?>>
                            <?= $band['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </optgroup>
            </select>
        </label>

        <div class="text-right ">
            <input type="submit" value="Submit" class="btn-style">
        </div>

    </div>
    <?php ActiveForm::end() ?>
</div>

