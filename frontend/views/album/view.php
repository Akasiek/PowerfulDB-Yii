<?php

/**
 * @var $model Album
 */

use common\models\Album;
use common\models\Track;
use yii\web\NotFoundHttpException;

if (!isset($model)) throw new NotFoundHttpException('Album not found');

//$otherAlbums = $author->getAlbums()->where('id != :id', ['id' => $model->id])->limit(10)->all();

?>


<?= $this->render('_view_album_jumbotron', [
    'model' => $model,
]); ?>


<div class="flex flex-col justify-center items-center mt-5 md:mt-10">
    <div class="flex flex-col gap-12 md:gap-16 px-5 md:px-10 lg:px-14 py-8 max-w-screen-lg w-full">

        <?= $this->render('@frontend/views/components/_render_article', [
            'model' => $model,
        ]); ?>

        <?= $this->render('_view_tracks_list', [
            'model' => $model,
        ]); ?>

        <?= $this->render('_view_albums_by_same_author', [
            'model' => $model,
        ]); ?>

    </div>
</div>