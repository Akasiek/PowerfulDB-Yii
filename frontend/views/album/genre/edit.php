<?php
/**
 * @var $album Album
 * @var $albumGenres AlbumGenre[]
 */

use common\models\Album;
use common\models\AlbumGenre;

$this->title = 'Edit Genre';
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex flex-col max-w-3xl mx-auto gap-6">
    <h1 class="form-title mb-2 mb:mb-4">Edit genres to album <?= $album->title ?></h1>

    <?= $this->render('_form', [
        'album' => $album,
        'albumGenres' => $albumGenres,
    ]) ?>
</div>
