<?php

/**
 * @var $albums Album[]
 */

use common\models\Album;
use yii\helpers\Url;


?>

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-x-4 lg:gap-x-6 xl:gap-x-8 gap-y-6 md:gap-y-12">
    <?php foreach ($albums as $album) : ?>
        <a href="<?= Url::to(['/album/view', 'slug' => $album->slug,]) ?>" class="group transition">
            <div class="group">
                <img class="group-hover:scale-95 transition" src="<?= $album->artwork_url ?>" alt="Album artwork">

                <div class="truncate px-1 py-2 md:p-2">
                    <p class="text-sm lg:text-base xl:text-lg font-bold truncate group-hover:underline" title="<?= $album->title ?>">
                        <?= $album->title ?>
                    </p>

                    <p class="text-xs md:text-sm truncate text-gray-400">
                        <?= Yii::$app->formatter->asDate($album->release_date, 'Y') ?>
                    </p>
                </div>
            </div>
        </a>
    <?php endforeach ?>
</div>