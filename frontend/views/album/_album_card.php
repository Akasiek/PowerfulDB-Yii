<?php

/**
 * @var $model Album
 */

use common\models\Album;
use yii\helpers\Url;

$genres = $model->getGenres()->all();
$genreText = implode(' • ', array_map(function ($genre) {
    return $genre->name;
}, $genres));


?>

<div class="group">

    <a href="<?= Url::to(['/album/view', 'slug' => $model->slug,]) ?>" class="block
    relative shadow-lg group-hover:scale-95 transition-transform ease-in-out">
        <img src="<?= $model->artwork_url ?: Yii::getAlias('@web/resources/images/no_image.jpg') ?>" alt="Album artwork"
             class="aspect-square object-cover object-center">
        <?php if ($model->type !== "LP") : ?>
            <p class="absolute bottom-0 right-0 text-xs md:text-sm font-bold bg-secondary-accent pr-1 md:pr-2 pl-2 md:pl-3 py-1 rounded-tl-xl md:rounded-tl-2xl">
                <?= $model->type ?>
            </p>
        <?php endif ?>
    </a>

    <div class="flex flex-col px-1 py-2 xl:p-2 truncate">
        <h3 class="font-bold text-sm lg:text-base xl:text-lg truncate">
            <a href="<?= Url::to([
                '/album/view',
                'slug' => $model->slug,
            ]) ?>" class="hover:underline transition underline-offset-2" title="<?= $model->title ?>">
                <?= $model->title ?>
            </a>
        </h3>

        <p class="text-sm truncate italic">
            <a href="<?= Url::to([
                '/' . ($model->artist_id ? 'artist' : 'band') . '/view/',
                'slug' => $model->artist->slug ?? $model->band->slug,
            ]) ?>" class="hover:underline transition" title="<?= $model->artist->name ?? $model->band->name ?>">
                <?= $model->artist->name ?? $model->band->name ?>
            </a>
        </p>

        <?php if (!empty($genres)) : ?>
            <p class="text-xs truncate italic text-gray-400" title="<?= $genreText ?>">
                <?= $genreText ?>
            </p>
        <?php endif; ?>
    </div>
</div>