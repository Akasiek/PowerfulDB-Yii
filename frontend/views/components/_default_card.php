<?php

/**
 * @var $model Artist | Band
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Url;

$genres = $model->getGenres()->limit(4)->all();

?>
<a href="<?= Url::to(['/' . ($model instanceof Artist ? 'artist' : 'band') . '/view', 'slug' => $model->slug]) ?>">
    <div class="rounded-3xl w-full h-40 md:h-48 !bg-cover flex flex-col justify-end items-start snap-start scroll-pl-3
                group overflow-hidden !bg-center relative group bg-secondary-dark">

        <img src="<?= $model->bg_image_url ?>" alt="" class="absolute h-full w-full object-center object-cover z-10
                    transition-all xl:group-hover:scale-110 opacity-95 xl:opacity-80 group-hover:opacity-100">

        <div class="absolute top-0 bottom-0 left-0 right-0 w-full z-20 group-hover:scale-125 transition-all" style="background: linear-gradient(180deg, rgba(94, 43, 255, 0),
            rgba(94, 43, 255, 0.5))">
        </div>

        <div class="px-4 md:px-7 pb-3 md:pb-4 w-full z-30">

            <h3 class="font-bold text-lg md:text-xl xl:text-2xl truncate 
            transition-transform drop-shadow-[0_2px_4px_rgba(0,0,0,0.15)]">
                <?php echo $model->name ?>
            </h3>

            <?php if (!empty($genres)) : ?>
                <p class="text-xs md:text-sm truncate drop-shadow-md
                      transition-transform group-hover:delay-100">
                    <?php
                    foreach ($genres as $index => $genre) {
                        echo $genre->name;
                        if ($index < count($genres) - 1) {
                            echo ' • ';
                        }
                    }
                    ?>
                </p>
            <?php endif; ?>

        </div>
    </div>
</a>