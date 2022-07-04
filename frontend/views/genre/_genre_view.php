<?php

/** 
 * @var $model Genre
 */

use common\models\Genre;
use yii\helpers\Url;

?>
<div class="w-full group">

    <div class="flex gap-3 items-end group-hover:text-main-accent transition-colors">

        <a href="<?= Url::to('/album/?genre=' . $model->name) ?>">
            <h1 class="text-3xl font-bold "><?= $model->name ?></h1>
        </a>

        <a href="<?= Url::to('/album/?genre=' . $model->name) ?>" class="text-lg text-gray-400 ">
            <?= $model->countAlbum ?> albums
        </a>

        <a href="<?= Url::to('/band/?genre=' . $model->name) ?>" class="text-lg text-gray-400 ">
            <?= $model->countBand ?> bands
        </a>

        <a href="<?= Url::to('/artist/?genre=' . $model->name) ?>" class="text-lg text-gray-400 ">
            <?= $model->countArtist ?> artists
        </a>

    </div>

    <hr class=" mt-3 border-t-2 border-gray-600 group-hover:border-main-accent transition-colors">

</div>