<?php

/**
 * @var $model Album
 */

use common\models\Album;
use yii\helpers\Html;
use yii\helpers\Url;

$genres = $model->getGenres()->all();

?>

<div class="flex mt-8 md:mt-12 lg:mt-16 justify-center w-full">

    <div class="flex flex-col md:flex-row justify-center items-center gap-5 xl:gap-10 max-w-screen-xl px-4 md:px-12 lg:px-16">
        <div class="relative group overflow-hidden">
            <img src="<?= $model->artwork_url ?: Yii::getAlias('@web/resources/images/no_image.jpg') ?>"
                 alt="Album artwork" class="w-64 md:w-72 lg:w-96 aspect-square object-cover object-center">
            <?php if (!Yii::$app->user->isGuest): ?>
                <a href="<?= Url::to(['edit', 'slug' => $model->slug]) ?>"
                   class="absolute bottom-0 right-0 pl-6 pr-1 pt-6 pb-1 lg:pl-8 lg:pr-2 lg:pt-8 lg:pb-2
                   md:translate-x-20 group-hover:translate-x-0 transition-transform aspect-square"
                   style="background: linear-gradient(to bottom right, transparent 0%, transparent 50%, #4EFFA6 50%, #4EFFA6 100%)">
                    <div class="material-symbols-outlined align-top text-secondary-dark lg:!text-3xl">
                        edit
                    </div>
                </a>
            <?php endif; ?>
        </div>
        <div class="flex flex-col items-center md:items-start gap-1 md:gap-2">

            <a href="<?= \yii\helpers\Url::to([
                '/' . ($model->artist_id ? 'artist' : 'band') . '/view/',
                'slug' => $model->artist->slug ?? $model->band->slug,
            ]) ?>" class="hover:underline">
                <h3 class="text-lg lg:text-2xl"><?= $model->artist->name ?? $model->band->name ?></h3>
            </a>

            <h1 class="text-2xl lg:text-4xl font-bold text-center md:text-left"><?= $model->title ?></h1>

            <p class="text-gray-400 text-sm lg:text-base">
                <?php
                if (isset($model->release_date)) {
                    echo Yii::$app->formatter->asDate($model->release_date, 'long') . " | ";
                }
                ?>
                <?= $model->type ?>
            </p>

            <?php if (!empty($genres)) : ?>
                <div class="text-sm md:text-base italic text-center md:text-left">
                    <?= implode(' • ', array_map(function ($genre) {
                        return $genre->name;
                    }, $genres)) ?>
                </div>
            <?php elseif (!Yii::$app->user->isGuest) : ?>
                <a class="text-sm underline text-gray-400"
                   href="<?= Url::to(['/album/genre-add', 'slug' => $model->slug]) ?>">
                    Add genres
                </a>
            <?php endif; ?>
        </div>
    </div>

</div>