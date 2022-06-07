<?php

use yii\helpers\Html;

?>

<div class="flex relative items-center justify-center w-full h-[650px] lg:h-[750px] bg-cover"
     style="background-image: url('<?php echo Yii::getAlias('@web/resources/images/jumbotron_bg.jpg') ?>')">
    <div class="flex items-center justify-center flex-col gap-3">
        <?php echo Html::img('@web/resources/logo/logo.svg',
            [
                'class' => 'h-32',
                'alt' => 'App logo'
            ]) ?>
        <p class="font-serif text-main-light text-lg lg:text-xl">
            Powerful Database of Rock and Metal Music
        </p>
    </div>
</div>