<?php
/**
 * @var $model Album
 */

use common\models\Album;
use yii\web\NotFoundHttpException;

if (!isset($model)) throw new NotFoundHttpException('Album not found');


if ($model->artist_id) $author = $model->artist;
else $author = $model->band;

$articleText = $model->getArticle()->asArray()->one()['text'] ?? '';
$otherAlbums = $author->getAlbums()->where('id != :id', ['id' => $model->id])->limit(10)->all();

?>


<?= $this->render('_album_jumbotron', [
    'model' => $model,
    'author' => $author,
]); ?>


<div class="flex flex-col justify-center items-center mt-5">
    <div class="px-14 py-8 max-w-screen-lg w-full">

        <?= $this->render('@frontend/views/components/_render_article', [
            'model' => $model,
            'articleText' => $articleText,
        ]); ?>

        <!-- ALBUM BY THE SAME AUTHOR-->
        <!-- TODO!-->
        <?php if ($otherAlbums): ?>
        <?php endif ?>

    </div>
</div>
