<?php
/**
 * @var $model Album
 * @var $form ActiveForm
 */

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use kartik\form\ActiveForm;
use yii\web\View;

// Check if there is a band or artist id parameter in the url
if (isset($_GET['band_id'])) {
    $paramBand = Band::find()->where(['id' => $_GET['band_id']])->one();
} elseif (isset($_GET['artist_id'])) {
    $paramArtist = Artist::find()->where(['id' => $_GET['artist_id']])->one();
}

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

<!-- NAME INPUT -->
<?= $form->field($model, 'title', [
    'errorOptions' => ['class' => 'text-red-500'],
])->textInput([
    'maxlength' => 255,
    'class' => 'input-style',
    'placeholder' => 'The Number of the Beast'
]) ?>

<!-- AUTHOR ID INPUT -->
<div class="required">
    <label for="select-slim" class="has-star">Choose artist or band</label>
    <select id="select-slim" name="author_id" class="input-style">

        <!-- If artist is set, use it as a default value. Otherwise, create a placeholder option-->
        <?php if (isset($paramArtist)) : ?>
            <option value="<?= 'artist-' . $paramArtist->id ?>" selected><?= $paramArtist->name ?></option>
        <?php elseif (isset($paramBand)) : ?>
            <option value="<?= 'band-' . $paramBand->id ?>" selected><?= $paramBand->name ?></option>
        <?php else : ?>
            <option data-placeholder="true" value="">Select an author</option>
        <?php endif; ?>

        <optgroup label="Artists">
            <?php foreach ($artists as $artist) : ?>
                <option value="<?= $artist['id'] ?>"
                    <?php if ($model->artist_id !== "" && 'artist-' . $model->artist_id === $artist['id']) echo "selected" ?>>
                    <?= $artist['name'] ?>
                </option>
            <?php endforeach; ?>
        </optgroup>

        <optgroup label="Bands">
            <?php foreach ($bands as $band) : ?>
                <option value="<?= $band['id'] ?>"
                    <?php if ($model->band_id !== "" && 'band-' . $model->band_id === $band['id']) echo "selected" ?>>
                    <?= $band['name'] ?>
                </option>
            <?php endforeach; ?>
        </optgroup>

    </select>
    <!-- Display custom error message for author_id -->
    <p class="text-red-500">
        <?= Yii::$app->session->getFlash('author_id') ?>
    </p>
</div>

<!-- RELEASE DATE INPUT -->
<?= $form->field($model, 'release_date', [
    'errorOptions' => ['class' => 'text-red-500'],
])->input('date', ['class' => 'input-style']) ?>

<!-- TYPE INPUT -->
<div class="required">
    <label for="select-slim-1" class="has-star">Choose type of album</label>
    <select name="type" id="select-slim-1" class="input-style">
        <?php foreach ($model::TYPES as $type) : ?>
            <option value="<?= $type ?>" <?php if ($model->type === $type) echo "selected" ?>><?= $type ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="flex justify-center items-center gap-4 sm:gap-6 md:gap-8 lg:gap-10">
    <!-- BACKGROUND IMAGE URL INPUT -->
    <?= $form->field($model, 'artwork_url', [
        'errorOptions' => ['class' => 'text-red-500'],
        'options' => ['class' => 'flex-1'],
    ])->textInput([
        'id' => 'image-url-input',
        'maxlength' => 2048,
        'class' => 'input-style',
        'placeholder' => 'Url'
    ]) ?>

    <!-- BACKGROUND IMAGE PREVIEW -->
    <img src="<?php echo Yii::getAlias('@web/resources/images/no_image.jpg') ?>" id="image-display"
         class="w-28 sm:w-32 md:w-36 lg:w-44 aspect-square object-cover object-center"
         alt="image uploaded by the user"/>
</div>

<!-- Display custom error message when album is a duplicate -->
<p class="text-red-500">
    <?= Yii::$app->session->getFlash('duplicate') ?>
</p>

<!-- SUBMIT BUTTON -->
<div class="text-right">
    <input type="submit" value="Submit" class="btn-style">
</div>

