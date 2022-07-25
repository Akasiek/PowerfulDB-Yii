<?php

/**
 * @var $model Album
 */

use common\models\Album;
use common\models\Track;
use yii\web\NotFoundHttpException;

if (!isset($model)) throw new NotFoundHttpException('Album not found');

$this->title = $model->title;
?>


<?= $this->render('_view_album_jumbotron', [
    'model' => $model,
]); ?>


<div class="flex flex-col gap-12 md:gap-16 px-5 md:px-10 lg:px-14 py-8 mt-5 md:mt-10 mx-auto max-w-screen-lg w-full">

    <?= $this->render('@frontend/views/components/_render_article', [
        'model' => $model,
    ]); ?>

    <?= $this->render('_view_tracks_list', [
        'model' => $model,
    ]); ?>

    <?= $this->render('_view_albums_by_same_author', [
        'model' => $model,
    ]); ?>

    <div class="flex flex-wrap gap-4">

        <?= \yii\helpers\Html::a('Edit album', ['edit', 'slug' => $model->slug], [
            'class' => 'rounded-xl px-4 py-1 bg-main-accent text-secondary-dark font-bold',
        ]) ?>

        <?= \yii\helpers\Html::a('Edit genres', ['genre-edit', 'slug' => $model->slug], [
            'class' => 'rounded-xl px-4 py-1 bg-main-accent text-secondary-dark font-bold',
        ]) ?>

    </div>

</div>