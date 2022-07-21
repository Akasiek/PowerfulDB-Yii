<?php

/**
 * @var $model Album
 */

use common\models\Album;
use yii\helpers\Url;

?>

<a href="<?= Url::to(['/album/view', 'slug' => $model->slug,]) ?>" class="group transition">
    <div class="group">
        <img class="group-hover:scale-95 transition" src="<?= $model->artwork_url ?>" alt="Album artwork">

        <div class="truncate px-1 py-2 md:p-2">
            <p class="text-sm lg:text-base xl:text-lg font-bold truncate group-hover:underline" title="<?= $model->title ?>">
                <?= $model->title ?>
            </p>

            <p class="text-xs md:text-sm truncate text-gray-400">
                <?= Yii::$app->formatter->asDate($model->release_date, 'Y') ?>
            </p>
        </div>
    </div>
</a>