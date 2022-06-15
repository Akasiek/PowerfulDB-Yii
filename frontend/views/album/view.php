<?php
/**
 * @var $model Album
 */

use common\models\Album;

if ($model->artist_id) $author = $model->artist;
else $author = $model->band;

$articleText = $model->getAlbumArticule()->asArray()->one()['text'] ?? '';

?>


<?= $this->render('_album_jumbotron', [
    'model' => $model,
    'author' => $author,
]); ?>


<div class="flex flex-col justify-center items-center mt-5">
    <div class="px-14 py-8">

        <?= $this->render('_album_article', [
            'model' => $model,
            'articleText' => $articleText,
        ]); ?>

    </div>
</div>
