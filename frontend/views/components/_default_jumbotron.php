<?php

/**
 * @var $model Artist | Band
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Url;

include Yii::getAlias('@frontend/web/ageDiff.php');

$genres = $model->getGenres()->limit(5)->all();

?>

<div class="!bg-cover !bg-center flex flex-col justify-end items-start w-full h-[650px] lg:h-[750px]
     relative group overflow-hidden"
     style="background:
             linear-gradient(180deg, rgba(94, 43, 255, 0) 30%,
             rgba(94, 43, 255, 0.85) 100%,
             rgba(94, 43, 255, 0.85) 100%),
             url('<?php echo $model->bg_image_url ?: Yii::getAlias('@web/resources/images/no_image.jpg') ?>'); ">
    <div class="px-6 md:px-12 lg:px-14 pb-6 md:pb-8 lg:pb-10 w-full flex flex-col gap-2">


        <div class="flex flex-col-reverse md:flex-col gap-1">
            <?php if (isset($model->full_name)) : ?>
                <p class="text-gray-300 italic drop-shadow-md"><?php echo $model->full_name ?></p>
            <?php endif; ?>
            <h3 class="font-sans text-5xl md:text-6xl lg:text-7xl drop-shadow-md"><?php echo $model->name ?></h3>
        </div>

        <?php if (!empty($genres)) : ?>
            <p class="text-sm md:text-base lg:text-lg xl:text-xl drop-shadow-sm">
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

        <?php if (isset($model->birth_date)) : ?>
            <div class="drop-shadow-sm">
                <p>
                    Age: <?php echo ageDiff($model->birth_date, $model->death_date) ?> years old
                </p>

                <p class="text-gray-300">
                    Born: <?php echo Yii::$app->formatter->asDate($model->birth_date, 'long') ?>
                </p>

                <?php if (isset($model->death_date)) : ?>
                    <p class="text-gray-300">
                        Died: <?php echo Yii::$app->formatter->asDate($model->death_date, 'long') ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($model->founding_year)) : ?>
            <div>

                <p class="drop-shadow-lg">
                    Years
                    active: <?php
                    echo $model->founding_year . ' - ';
                    echo $model->breakup_year ?? "present"; ?>
                </p>

            </div>
        <?php endif; ?>
    </div>

    <?php if (!Yii::$app->user->isGuest): ?>
        <a href="<?= Url::to(['edit', 'slug' => $model->slug]) ?>"
           class="absolute bottom-0 right-0 pl-6 pr-1 pt-6 pb-1 lg:pl-8 lg:pr-2 lg:pt-8 lg:pb-2
                   md:translate-x-20 group-hover:translate-x-0 transition-transform aspect-square"
           style="background: linear-gradient(to bottom right, transparent 0%, transparent 50%, #4EFFA6 50%, #4EFFA6 100%)">
            <div class="material-symbols-outlined align-top text-secondary-dark lg:!text-3xl">
                edit
            </div>
        </a>
    <?php endif; ?>
</div>