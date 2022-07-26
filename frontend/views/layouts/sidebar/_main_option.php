<?php

/**
 * @var $icon string
 * @var $text string
 * @var $url string
 */

use common\models\EditSubmission;
use yii\helpers\Url;

?>
<div class="main-options w-full">
    <a class="w-full flex items-center justify-start gap-4
    option text-main-light hover:text-main-accent transition-colors
    cursor-pointer hover:shadow-accent group" href="<?php echo Url::to([$url]) ?>">
        <span class="material-symbols-rounded !text-2xl xl:!text-3xl">
            <?= $icon ?>
        </span>
        <div class="text-base xl:text-lg">
            <?= $text ?>
        </div>
        <?php $subCount = EditSubmission::find()->where(["status" => 0])->count() ?>
        <?php if ($text === "Submissions" && $subCount !== 0): ?>
            <div class="h-5 aspect-square rounded-full bg-secondary-accent
            !text-main-light flex items-center justify-center text-sm">
                <?= $subCount ?>
            </div>
        <?php endif ?>
    </a>
</div>