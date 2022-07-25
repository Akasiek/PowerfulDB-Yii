<?php
/**
 * @var $album Album
 */

use common\models\Album;
use yii\helpers\Url;

$this->title = 'Add Genre';
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex flex-col max-w-3xl mx-auto gap-6">
    <div>
        <h1 class="form-title mb-2 mb:mb-4">Add genres to album <?= $album->title ?></h1>

        <p class="text-xs sm:text-sm md:text-base">
            If you didn't find the appropriate genre try adding it
            <a href="<?= Url::to('/genre/create') ?>" class="text-main-accent hover:underline">in the genre create
                page</a>
        </p>
    </div>

    <?= $this->render('_form', [
        'album' => $album,
    ]) ?>
</div>