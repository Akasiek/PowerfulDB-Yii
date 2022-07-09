<?php

use yii\helpers\Html;

?>

<div class="flex relative items-center justify-center w-full h-[650px] lg:h-[750px] bg-cover">
    <img src="<?= Yii::getAlias('@web/resources/images/jumbotron_bg.jpg') ?>" class="z-0 absolute object-cover object-center h-full w-full" alt="Jumbotron background image">
    <div class="z-10 flex items-center justify-center flex-col gap-3">
        <?php echo Html::img(
            '@web/resources/logo/logo.svg',
            [
                'class' => 'h-16 md:h-20 lg:h-28 xl:h-32 px-4',
                'alt' => 'App logo'
            ]
        ) ?>
        <p class="font-serif text-main-light px-4 text-sm md:text-lg lg:text-xl">
            Powerful Database of Rock and Metal Music
        </p>
    </div>
</div>