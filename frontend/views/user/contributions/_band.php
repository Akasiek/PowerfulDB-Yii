<?php
/**
 * @var $contrib Band
 * @var $model User
 */

use common\models\Band;
use common\models\User;
use yii\helpers\Html;

?>

<span class="material-symbols-rounded !text-lg xl:!text-xl">
    groups
</span>
<p>
    <?= $model->username . ' created band called ' ?>
    <?= Html::a(
        $contrib->name,
        ['band/view', 'slug' => $contrib->slug],
        ['class' => 'font-bold text-main-accent hover:underline']
    ) ?>
    <span class="text-gray-500 italic hidden md:inline">
        + 3 points
    </span>
</p>