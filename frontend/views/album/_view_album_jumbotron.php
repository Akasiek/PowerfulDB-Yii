<?php

/**
 * @var $model Album
 */

use common\models\Album;
use common\models\Genre;
use yii\helpers\Url;

$genres = $model->getGenres()->all();

?>

<div class="flex mt-16 justify-center w-full">

    <div class="flex justify-center items-center gap-5 xl:gap-10 max-w-screen-xl px-16">
        <div>
            <img src="<?= $model->artwork_url ?>" alt="Album artwork" class="w-96">
        </div>
        <div class="flex flex-col gap-2">

            <a href="<?= \yii\helpers\Url::to([
                            '/' . ($model->artist_id ? 'artist' : 'band') . '/view/',
                            'slug' => $model->artist->slug ?? $model->band->slug,
                        ]) ?>" class="hover:underline">
                <h3 class="text-lg lg:text-2xl"><?= $model->artist->name ?? $model->band->name ?></h3>
            </a>

            <h1 class="text-2xl lg:text-5xl font-bold"><?= $model->title ?></h1>

            <p class="text-gray-400 text-sm lg:text-base">
                <?php
                if (isset($model->release_date)) {
                    echo Yii::$app->formatter->asDate($model->release_date, 'long');
                }
                ?>
            </p>

            <?php if (!empty($genres)) : ?>
                <p class="italic text-sm lg:text-base">
                    <?php
                    foreach ($genres as $index => $genre) {
                        echo $genre->name . ' ';
                        if ($index < count($genres) - 1) {
                            echo '• ';
                        }
                    }
                    ?>
                </p>
            <?php else : ?>
                <a class="text-sm underline text-gray-400" href="<?= Url::to(['/album/genre-add', 'slug' => $model->slug]) ?>">
                    Add genres
                </a>
            <?php endif; ?>
        </div>
    </div>

</div>