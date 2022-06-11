<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>


<aside class="h-screen !w-72 w-96 position-fixed transition-all" id="sidebar">
    <div class="bg-main-dark h-full p-5 gap-6 flex flex-col font-serif font-bold relative">

        <!-- LOGO -->
        <div class="flex items-center justify-center">
            <a href="<?php echo Url::to('/') ?>" class="h-11">
                <?php echo Html::img('@web/resources/logo/logo.svg',
                    [
                        'class' => 'h-full',
                        'alt' => 'App logo'
                    ]) ?>
            </a>
        </div>

        <!-- SEARCHBAR -->
        <div class="relative flex items-center">
            <input
                    class="w-full px-4 py-1.5 border-2 border-main-accent rounded-3xl bg-transparent font-bold text-lg text-main-light
                    focus:outline-none focus:bg-main-accent focus:text-secondary-dark focus:placeholder:text-secondary-dark
                    shadow-accent peer transition-all duration-300"
                    id="searchInput"
                    type="text"
                    placeholder="Search..."
                    autocomplete="none">
            <div class="absolute flex right-4 text-main-accent peer-focus:text-main-dark transition-all duration-300">
                    <span class="material-symbols-rounded cursor-pointer ">
                        search
                    </span>
            </div>
        </div>

        <!-- MAIN OPTIONS -->
        <div class="flex gap-3 flex-col">
            <?php echo $this->render('_main_option', [
                'text' => 'Home Page',
                'icon' => 'home',
                'url' => '/',
            ]) ?>

            <?php echo $this->render('_main_option', [
                'text' => 'Artists',
                'icon' => 'mic_external_on',
                'url' => '/artist',
            ]) ?>

            <?php echo $this->render('_main_option', [
                'text' => 'Bands',
                'icon' => 'groups',
                'url' => '/band',
            ]) ?>

            <?php echo $this->render('_main_option', [
                'text' => 'Albums',
                'icon' => 'album',
                'url' => '/album',
            ]) ?>

            <?php echo $this->render('_main_option', [
                'text' => 'Users',
                'icon' => 'account_circle',
                'url' => '/user',
            ]) ?>
        </div>

        <hr class="border-t-2 border-t-[rgba(255,255,255,0.15)]">

        <!-- SIDE OPTIONS -->
        <?php echo $this->render('_main_option', [
            'text' => 'About',
            'icon' => 'info',
            'url' => '/about',
        ]) ?>

        <!-- PROFILE / LOG IN -->
        <div class="text-secondary-dark bg-main-accent absolute left-0 right-0 bottom-0 px-4 py-3">
            <?php
            if (Yii::$app->user->isGuest): ?>
                <a href="<?php echo Url::to('/site/login') ?>"
                   class="flex items-center justify-start gap-4">
                    <p class="material-symbols-rounded !text-3xl">
                        account_circle
                    </p>
                    <p class="font-bold text-lg">
                        Log in
                    </p>
                </a>
            <?php else: ?>
                <div class="flex items-center gap-4">
                    <div class="aspect-square flex-none">
                        <!-- TODO: Avatar display-->
                        <?php echo Html::a(
                            Html::img(
                                'https://icon-library.com/images/default-profile-icon/default-profile-icon-16.jpg',
                                ['class' => 'rounded-full h-8 object-cover']
                            ), ['/users/view', 'id' => Yii::$app->user->identity->id])
                        ?>
                    </div>
                    <div class="truncate pr-6">
                        <p class="text-xl truncate">
                            <?php echo Html::a(
                                Yii::$app->user->identity->username,
                                ['/users/view', 'id' => Yii::$app->user->identity->id]
                            ) ?>
                        </p>
                    </div>

                    <div class="absolute right-4 flex">
                        <a href="<?php echo Url::to('/site/logout') ?>"
                           data-method="post"
                           class="material-symbols-outlined text-secondary-dark font-normal">
                            logout
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>

</aside>

