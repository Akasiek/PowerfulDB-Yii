<?php

/** 
 * @model User 
 */

use common\models\User;
use yii\helpers\Url;

?>
<a href="<?= Url::to(['/user/view', 'id' => $model->id]) ?>">
    <div class="bg-main-dark rounded-2xl overflow-hidden">
        <div class="bg-main-accent py-4 px-2 flex items-center justify-center">
            <img src="<?= $model->profile_pic_url ?? 'https://icon-library.com/images/default-profile-icon/default-profile-icon-16.jpg' ?>" alt="" class="rounded-full object-cover object-center aspect-square h-16 shadow-lg">
        </div>

        <div class="py-5 flex items-center px-4 justify-center truncate">
            <h3 class="font-bold text-xl truncate" title="<?= $model->username ?>">
                <?= $model->username ?>
            </h3>
        </div>
    </div>
</a>