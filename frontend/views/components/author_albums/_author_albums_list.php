<?php
/**
 * @var $albums Album[]
 */

use common\models\Album;
use yii\helpers\Url;

?>

<div class="flex flex-col justify-center items-center m-auto">
    <?php $i = 0 ?>
    <?php foreach ($albums as $album): ?>
        <a href="<?= Url::to(['/album/view', 'slug' => $album->slug,]) ?>"
           class="w-full">
            <div class="flex justify-center items-center w-full">
                <div class="h-36 m-10">
                    <img src="<?= $album->artwork_url ?>" alt="Album artwork" class="h-full">

                </div>

                <div class="col-span-2 w-full flex-1">
                    <h2 class="text-2xl"><?= $album->title ?></h2>
                    <p class="italic text-gray-400">
                        <?= Yii::$app->formatter->asDate($album->release_date, 'long') ?>
                    </p>
                </div>
            </div>
        </a>
        <?php if (++$i !== count($albums)): ?>
            <hr class="my-8 border-t-2 border-t-gray-700 w-[60%] mx-auto">
        <?php endif ?>

    <?php endforeach ?>
</div>
