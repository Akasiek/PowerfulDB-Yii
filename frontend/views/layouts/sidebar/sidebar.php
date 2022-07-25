<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<div class="w-screen px-4 md:px-8 bg-main-dark md:hidden flex justify-between items-center h-14">
    <a href="<?= Url::to('/') ?>" class="">
        <?= Html::img(
            '@web/resources/logo/logo.svg',
            [
                'class' => 'w-40 md:w-48 object-cover',
                'alt' => 'App logo',
            ]
        ) ?>
    </a>
    <span class="material-symbols-rounded mb-1 cursor-pointer" id="menu-show">
        menu
    </span>
    <span class="material-symbols-rounded mb-1 !hidden cursor-pointer" id="menu-hide">
        close
    </span>
</div>
<aside class="min-h-[40rem] h-[calc(100vh-3.5rem)] md:h-screen w-screen md:w-56 lg:w-60 xl:w-72 position-fixed transition-all hidden md:block md:static relative inset-0"
       id="sidebar">
    <div class="bg-main-dark h-full pt-2 md:pt-4 sm:px-8 px-12 md:px-4 lg:px-5 gap-6 md:gap-4 xl:gap-6 flex flex-col md:items-start items-center md:justify-start justify-center font-serif font-bold relative pb-14">

        <!-- LOGO -->
        <div class="md:flex items-center justify-center hidden">
            <a href="<?= Url::to('/') ?>" class="h-11">
                <?= Html::img(
                    '@web/resources/logo/logo.svg',
                    [
                        'class' => 'h-full',
                        'alt' => 'App logo',
                    ]
                ) ?>
            </a>
        </div>


        <!-- SEARCHBAR -->
        <form action="/search" method="get" class="relative flex items-center max-w-sm w-full">
            <input id="search-input" type="text" placeholder="Search..." autocomplete="none" name="keyword"
                   minlength="2" class="w-full
                    px-4 py-1 xl:py-1.5 border-2 border-main-accent rounded-3xl bg-transparent
                    font-bold xl:text-lg text-main-light focus:outline-none focus:bg-main-accent
                    focus:text-secondary-dark focus:placeholder:text-secondary-dark shadow-accent
                    peer transition-all duration-300">
            <div class="absolute flex right-4 text-main-accent peer-focus:text-main-dark transition-all duration-300">
                <input id="search-submit" type="submit" value="search"
                       class="material-symbols-rounded cursor-pointer disabled:cursor-default !text-xl xl:!text-2xl"/>
            </div>

        </form>

        <div class="gap-4 md:gap-3 lg:gap-4 xl:gap-4 flex flex-col md:m-0 max-w-sm w-full md:px-0">

            <!-- MAIN OPTIONS -->
            <div class="grid w-full gap-3 md:gap-2 xl:gap-3">
                <?= $this->render('_main_option', [
                    'text' => 'Home Page',
                    'icon' => 'home',
                    'url' => '/',
                ]) ?>

                <?= $this->render('_main_option', [
                    'text' => 'Artists',
                    'icon' => 'mic_external_on',
                    'url' => '/artist',
                ]) ?>

                <?= $this->render('_main_option', [
                    'text' => 'Bands',
                    'icon' => 'groups',
                    'url' => '/band',
                ]) ?>

                <?= $this->render('_main_option', [
                    'text' => 'Albums',
                    'icon' => 'album',
                    'url' => '/album',
                ]) ?>

                <?= $this->render('_main_option', [
                    'text' => 'Genres',
                    'icon' => 'collections_bookmark',
                    'url' => '/genre',
                ]) ?>

                <?= $this->render('_main_option', [
                    'text' => 'Users',
                    'icon' => 'account_circle',
                    'url' => '/user',
                ]) ?>

                <!-- IF USER IS ADMIN DISPLAY SUBMISSION BTN-->
                <?php if (Yii::$app->user->can('submissionPanel')): ?>
                    <?= $this->render('_main_option', [
                        'text' => 'Submissions',
                        'icon' => 'edit_note',
                        'url' => '/submission',
                    ]) ?>
                <?php endif; ?>
            </div>

            <hr class="border-t-2 border-t-[rgba(255,255,255,0.15)]">

            <!-- SIDE OPTIONS -->
            <?= $this->render('_main_option', [
                'text' => 'About',
                'icon' => 'info',
                'url' => '/about',
            ]) ?>
        </div>

        <!-- PROFILE / LOG IN -->
        <div class="text-secondary-dark bg-main-accent block md:absolute w-full max-w-sm bottom-0 right-0 left-0 px-3 md:px-4 py-3">
            <?php
            if (Yii::$app->user->isGuest) : ?>
                <a href="<?= Url::to('/site/login') ?>" class="flex items-center justify-start gap-3 md:gap-4">
                    <p class="material-symbols-outlined !text-xl md:!text-2xl">
                        login
                    </p>
                    <p class="font-bold md:text-lg">
                        Log in
                    </p>
                </a>
            <?php else : ?>
                <div class="flex justify-between">
                    <div class="flex items-center gap-4">
                        <div class="aspect-square flex-none">
                            <?= Html::a(
                                Html::img(
                                    Yii::$app->user->identity->profile_pic_url ?? 'https://icon-library.com/images/default-profile-icon/default-profile-icon-16.jpg',
                                    ['class' => 'rounded-full w-full h-6 lg:h-8 aspect-square object-cover object-center']
                                ),
                                ['/user/view', 'id' => Yii::$app->user->identity->id]
                            );
                            ?>
                        </div>
                        <div class="truncate pr-6">
                            <p class="lg:text-xl font-bold truncate">
                                <?= Html::a(
                                    Yii::$app->user->identity->username,
                                    ['/user/view', 'id' => Yii::$app->user->identity->id]
                                ) ?>
                            </p>
                        </div>
                    </div>
                    <div class="">
                        <a href="<?= Url::to('/site/logout') ?>" data-method="post"
                           class="material-symbols-outlined text-secondary-dark font-normal !text-lg lg:!text-2xl">
                            logout
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</aside>