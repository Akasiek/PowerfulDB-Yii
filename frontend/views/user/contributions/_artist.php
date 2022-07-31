<?php
/**
 * @var $contrib Artist
 * @var $model User
 */

use common\models\Artist;
use common\models\User;
use yii\helpers\Html;

?>

<span class="material-symbols-rounded !text-lg xl:!text-xl">
    mic_external_on
</span>
<p>
    <?= $model->username . ' created artist called ' ?>
    <?= Html::a(
        $contrib->name,
        ['artist/view', 'slug' => $contrib->slug],
        ['class' => 'font-bold text-main-accent hover:underline']
    ) ?>
    <span class="text-gray-500 italic hidden md:inline">
        + 3 points
    </span>
</p>