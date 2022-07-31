<?php
/**
 * @var $contrib AlbumGenre
 * @var $model User
 */

use common\models\AlbumGenre;
use common\models\User;
use yii\helpers\Html;

?>

<span class="material-symbols-rounded !text-lg xl:!text-xl">
    collections_bookmark
</span>
<p>
    <?= $model->username . ' added '; ?>
    <span class="font-bold">
                    <?= $contrib->genre_count . ($contrib->genre_count === 1 ? ' genre ' : ' genres ') ?>
                </span>
    <?= ' to the album called ' ?>
    <?= Html::a(
        $contrib->album->title,
        ['album/view', 'slug' => $contrib->album->slug],
        ['class' => 'italic text-main-accent hover:underline']
    ) ?>
    <span class="text-gray-500 italic hidden md:inline">
        <?= '+ ' . $contrib->genre_count . ($contrib->genre_count === 1 ? ' point' : ' points') ?>
    </span>
</p>