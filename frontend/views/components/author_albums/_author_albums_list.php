<?php

/**
 * @var $albums Album[]
 */

use common\models\Album;
use yii\helpers\Url;

?>

<div class="flex flex-col justify-center items-center m-auto">
    <?php foreach ($albums as $index => $album) : ?>
        <a href="<?= Url::to(['/album/view', 'slug' => $album->slug,]) ?>" class="w-full">
            <div class="flex justify-center items-center w-full">
                <div class="h-36 m-10">
                    <img src="<?= $album->artwork_url ?>" alt="Album artwork" class="h-full">

                </div>

                <div class="col-span-2 w-full flex-1">
                    <h2 class="text-2xl"><?= $album->title ?></h2>
                    <p class="italic text-gray-400">
                        <?= Yii::$app->formatter->asDate($album->release_date, 'long') ?>
                    </p>
                    <?php
                    $genres = $album->getGenres()->all();
                    if (!empty($genres)) : ?>
                        <p class="italic text-sm text-gray-400">
                            <?php
                            foreach ($genres as $indexGenre => $genre) {
                                echo $genre->name . ' ';
                                if ($indexGenre < count($genres) - 1) {
                                    echo '• ';
                                }
                            }
                            ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </a>
        <?php if ($index + 1 !== count($albums)) : ?>
            <hr class="my-8 border-t-2 border-t-gray-700 w-[60%] mx-auto">
        <?php endif; ?>

    <?php endforeach ?>
</div>