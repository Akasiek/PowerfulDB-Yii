<?php
/**
 * @var $contrib Track
 * @var $model User
 */

use common\models\Track;
use common\models\User;
use yii\helpers\Html;

?>
<span class="material-symbols-rounded !text-lg xl:!text-xl">
    library_music
</span>
<p>
    <?= $model->username . ' added '; ?>
    <span class="font-bold">
        <?= $contrib->track_count . ($contrib->track_count === 1 ? ' track ' : ' tracks ') ?>
    </span>
    <?= ' to the album called ' ?>
    <?= Html::a(
        $contrib->album->title,
        ['album/view', 'slug' => $contrib->album->slug],
        ['class' => 'italic text-main-accent hover:underline']
    ) ?>
    <span class="text-gray-500 italic hidden md:inline">
        <?= '+ ' . $contrib->track_count . ($contrib->track_count === 1 ? ' point' : ' points') ?>
    </span>
</p>
