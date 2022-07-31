<?php
/**
 * @var $contrib Album
 * @var $model User
 */

use common\models\Album;
use common\models\User;
use yii\helpers\Html;

?>

<span class="material-symbols-rounded !text-lg xl:!text-xl">
    album
</span>
<p>
    <?= $model->username . ' created' ?>
    <?= $contrib->type !== "LP" ? strtolower($contrib->type) : " album " . "called" ?>
    <?= Html::a(
        $contrib->title,
        ['album/view', 'slug' => $contrib->slug],
        ['class' => 'font-bold text-main-accent hover:underline']
    ) . ' by ' ?>
    <?php if ($contrib->artist_id) {
        echo Html::a(
            $contrib->artist->name,
            ['artist/view', 'slug' => $contrib->artist->slug],
            ['class' => 'italic text-main-accent hover:underline']
        );
    } else {
        echo Html::a(
            $contrib->band->name,
            ['band/view', 'slug' => $contrib->band->slug],
            ['class' => 'italic text-main-accent hover:underline']
        );
    } ?>
    <span class="text-gray-500 italic hidden md:inline">
        + 3 points
    </span>
</p>
