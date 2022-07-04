<?php

/** 
 * @var $model Genre
 */

use common\models\Genre;

?>
<a href="" class="w-full group">
    <div class="flex gap-3 items-end group-hover:text-main-accent transition-colors">
        <h1 class="text-3xl "><?= $model->name ?></h1>
        <p class="text-lg text-gray-400 italic ">
            <?= $model->countGenre ?> albums
        </p>
    </div>
    <hr class=" mt-3 border-t-2 border-gray-600 group-hover:border-main-accent transition-colors">
</a>