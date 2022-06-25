<?php
/**
 * @var $albums Album[]
 */

use common\models\Album;
use yii\helpers\Url;

?>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
    <?php foreach ($albums as $album): ?>
        <a href="<?= Url::to(['/album/view', 'slug' => $album->slug,]) ?>"
           class="group transition">
            <div class="flex flex-col justify-center items-center group">
                <img class="mb-2 group-hover:scale-95 transition" src="<?= $album->artwork_url ?>" alt="Album artwork">

                <p class="text-base lg:text-lg truncate group-hover:underline"
                   title="<?= $album->title ?>">
                    <?= $album->title ?>
                </p>

                <p class="text-sm truncate text-gray-400">
                    <?= Yii::$app->formatter->asDate($album->release_date, 'Y') ?>
                </p>
            </div>
        </a>
    <?php endforeach ?>
</div>