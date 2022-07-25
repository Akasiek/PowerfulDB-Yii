<?php
/**
 * @var $album Album
 * @var $albumGenres AlbumGenre[]
 */

use common\models\Album;
use common\models\AlbumGenre;
use common\models\Genre;
use kartik\form\ActiveForm;

$genres = Genre::find()->all();

if (isset($albumGenres)) {
    $genreIds = array_map(function (AlbumGenre $albumGenre) {
        return $albumGenre->genre_id;
    }, $albumGenres);
}
?>


<?php $form = ActiveForm::begin([
    'class' => 'w-full',
]) ?>
<div class="flex flex-col gap-6 w-full">
    <div class="required w-full">
        <label for="genres[]" class="has-star">Choose genres</label>
        <select id="select-slim" name="genres[]" class="input-style w-full" multiple>

            <?php foreach ($genres as $genre) : ?>
                <option value="<?= $genre->id ?>"
                    <?php if (isset($albumGenres) && in_array($genre->id, $genreIds)) echo "selected" ?>
                ><?= $genre->name ?></option>
            <?php endforeach; ?>


        </select>
    </div>

    <div class="text-right">
        <input type="submit" value="Submit" class="btn-style">
    </div>
</div>
<?php ActiveForm::end() ?>
