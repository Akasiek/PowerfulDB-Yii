<?php

/** 
 * @model User 
 */

use common\models\User;
use yii\helpers\Url;

?>
<a href="<?= Url::to(['/user/view', 'id' => $model->id]) ?>">
    <div class="bg-main-dark rounded-2xl overflow-hidden">
        <div class="bg-main-accent py-2 md:py-4 px-2 flex items-center justify-center">
            <img src="<?= $model->profile_pic_url ?? 'https://icon-library.com/images/default-profile-icon/default-profile-icon-16.jpg' ?>" alt="" class="rounded-full object-cover object-center aspect-square h-12 md:h-14 lg:h-16 shadow-lg">
        </div>

        <div class="flex items-center justify-center truncate px-2 md:px-4 py-3 md:py-5">
            <h3 class="font-bold text-base md:text-xl truncate" title="<?= $model->username ?>">
                <?= $model->username ?>
            </h3>
        </div>
    </div>
</a>