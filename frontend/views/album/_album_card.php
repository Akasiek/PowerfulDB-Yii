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

    <a href="<?= Url::to([
                    '/album/view',
                    'slug' => $model->slug,
                ]) ?>">

        <img src="<?= $model->artwork_url ?>" alt="Album artwork" class="shadow-lg group-hover:scale-95 transition-transform ease-in-out">
    </a>

    <div class="flex flex-col px-1 py-2 md:p-2 truncate">

        <h3 class="text-base font-bold lg:text-lg truncate">
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