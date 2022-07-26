<?php
/**
 * @var $model Track
 */

use common\models\Track;
use common\models\Artist;
use common\models\Band;
use kartik\form\ActiveForm;

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

<?php $form = ActiveForm::begin() ?>
    <div class="flex flex-col gap-6 md:gap-10 text-sm sm:text-base md:text-lg w-full">

        <?= $form->field($model, 'title', [
            'errorOptions' => ['class' => 'text-red-500'],
        ])->textInput([
            'maxlength' => true,
            'class' => 'input-style',
        ]) ?>

        <div>
            <p class="mb-4">
                <span class="text-red-500">Warning:</span> If position is colliding with already present track, all
                tracks above it will be moved be one
                position.
            </p>
            <?= $form->field($model, 'position', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('number', [
                'class' => 'input-style',
            ]) ?>
        </div>


        <?= $form->field($model, 'duration'
        )->input('time', [
            'step' => 1,
            'class' => 'input-style',
            'value' => $model->duration ?: '00:00:00',
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


        <div class="flex justify-between">
            <?php if (!$model->isNewRecord) : ?>
                <?= \yii\helpers\Html::a('Delete', [
                    'track-delete', 'id' => $model->id,
                ], [
                    'class' => 'btn-style-warning'
                ]) ?>
            <?php endif; ?>
            <input type="submit" value="Submit" class="ml-auto btn-style">
        </div>
    </div>
<?php ActiveForm::end() ?>