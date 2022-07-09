<?php

/**
 * @var $icon string
 * @var $text string
 * @var $url string
 */

use yii\helpers\Url;

?>
<!-- md:bg-transparent md:p-0 md:rounded-none bg-secondary-dark py-1 px-4 rounded-2xl -->

<div class="main-options flex">
    <div class="option text-main-light hover:text-main-accent transition-colors cursor-pointer hover:shadow-accent
    ">
        <a class="flex items-center justify-start gap-4" href="<?php echo Url::to([$url]) ?>">
            <span class="material-symbols-rounded !text-2xl lg:!text-3xl">
                <?= $icon ?>
            </span>
            <div class="text-base lg:text-lg">
                <?= $text ?>
            </div>
        </a>
    </div>
</div>