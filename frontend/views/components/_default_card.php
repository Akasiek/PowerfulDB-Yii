<?php

/**
 * @var $model Artist | Band
 * @var $baseUrl string
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;
use yii\helpers\Url;

$genres = $model->getGenres()->limit(4)->all();

?>
<a href="<?php echo Url::to(['/' . (isset($baseUrl) ? $baseUrl : Yii::$app->controller->id) . '/view', 'slug' => $model->slug]) ?>">
    <div class="rounded-3xl w-full h-48 !bg-cover flex flex-col justify-end items-start snap-start scroll-pl-3
                group overflow-hidden !bg-center relative group bg-secondary-dark">

        <img src="<?= $model->bg_image_url ?>" alt="" class="absolute h-full w-full object-center object-cover z-10
                    transition-all xl:group-hover:scale-110 opacity-95 xl:opacity-80 group-hover:opacity-100">

        <div class="absolute top-0 bottom-0 left-0 right-0 w-full z-20 group-hover:scale-125 transition-all" style="background: linear-gradient(180deg, rgba(94, 43, 255, 0),
            rgba(94, 43, 255, 0.5))">
        </div>

        <div class="px-7 pb-4 w-full z-30">

            <h3 class="font-sans text-3xl truncate 
            transition-transform drop-shadow-[0_2px_4px_rgba(0,0,0,0.15)]">
                <?php echo $model->name ?>
            </h3>

            <?php if (!empty($genres)) : ?>
                <p class="text-sm truncate  drop-shadow-md
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