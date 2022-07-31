<?php
/**
 * @var $contrib BandMember
 * @var $model User
 */

use common\models\BandMember;
use common\models\User;
use yii\helpers\Html;

?>

<span class="material-symbols-rounded !text-lg xl:!text-xl">
    person_add
</span>
<p>
    <?= $model->username . ' added '; ?>
    <span class="font-bold">
        <?= $contrib->member_count . ($contrib->member_count === 1 ? ' member ' : ' members ') ?>
    </span>
    <?= ' to the band called ' ?>
    <?= Html::a(
        $contrib->band->name,
        ['band/view', 'slug' => $contrib->band->slug],
        ['class' => 'italic text-main-accent hover:underline']
    ) ?>
    <span class="text-gray-500 italic hidden md:inline">
        <?= '+ ' . $contrib->member_count . ($contrib->member_count === 1 ? ' point' : ' points') ?>
    </span>
</p>