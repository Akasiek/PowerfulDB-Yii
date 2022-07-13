<?php

/** 
 * @var $model Genre
 */

use common\models\Genre;
use yii\helpers\Url;

?>
<div class="w-full group">

    <div class="flex flex-wrap gap-y-0 gap-x-3 flex-col md:flex-row items-start md:items-end group-hover:text-main-accent transition-colors">

        <a href="<?= Url::to('/album/?genre=' . $model->name) ?>">
            <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold "><?= $model->name ?></h1>
        </a>

        <div class="flex gap-3 text-sm sm:text-base lg:text-lg text-gray-400">
            <a href="<?= Url::to('/album/?genre=' . $model->name) ?>" class="transition-colors <?php if ($model->countAlbum !== 0) echo 'hover:text-main-accent' ?>">
                <?= $model->countAlbum ?> albums
            </a>

            <a href="<?= Url::to('/band/?genre=' . $model->name) ?>" class="transition-colors <?php if ($model->countBand !== 0) echo 'hover:text-main-accent' ?>">
                <?= $model->countBand ?> bands
            </a>

            <a href="<?= Url::to('/artist/?genre=' . $model->name) ?>" class="transition-colors <?php if ($model->countArtist !== 0) echo 'hover:text-main-accent' ?> ">
                <?= $model->countArtist ?> artists
            </a>
        </div>

    </div>

    <hr class=" mt-3 border-t-2 border-gray-600 group-hover:border-main-accent transition-colors">

</div>