<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="w-full">

    <div class="bg-secondary-accent flex flex-wrap gap-6 justify-between px-6 lg:px-16 xl:px-24 py-6 md:py-8">

        <div class="flex items-center justify-center">
            <a href="<?= Url::to('/') ?>" class="h-8">
                <?= Html::img(
                    '@web/resources/logo/logo.svg',
                    [
                        'class' => 'h-full',
                        'alt' => 'App logo',
                    ]
                ) ?>
            </a>
        </div>

        <div class="flex gap-4 md:gap-8 sm:text-sm md:text-base lg:text-lg font-bold items-center">
            <a href="/artist">Artists</a><a href="/band">Bands</a><a href="/album">Albums</a><a href="/user">Users</a>
        </div>

    </div>


    <div class="bg-main-dark flex flex-wrap items-center gap-4 justify-between px-6 lg:px-16 xl:px-24 py-4">

        <p class="text-base">
            Made with 💜 and
            <a href="https://www.yiiframework.com/" class="underline">Yii Framework</a>
        </p>

        <div class="text-2xl flex gap-6 items-center">

            <a href="https://github.com/Akasiek/PowerfulDB" class="fa-brands fa-github"></a>
            <a href="https://www.linkedin.com/in/kamil-pomykala/" class="fa-brands fa-linkedin"></a>
        </div>

    </div>

</div>