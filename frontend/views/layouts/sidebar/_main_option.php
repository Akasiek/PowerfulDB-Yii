<?php

/**
 * @var $icon string
 * @var $text string
 * @var $url string
 */

use yii\helpers\Url;

?>


<div class="main-options">
    <div class="option text-main-light hover:text-main-accent transition-colors cursor-pointer hover:shadow-accent">
        <a class="flex items-center justify-start gap-4" href="<?php echo Url::to([$url]) ?>">
            <span class="material-symbols-rounded !text-3xl">
                <?php echo $icon ?>
            </span>
            <div class="text-lg">
                <?php echo $text ?>
            </div>
        </a>
    </div>
</div>