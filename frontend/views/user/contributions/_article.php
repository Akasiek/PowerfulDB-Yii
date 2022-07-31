<?php
/**
 * @var $contrib AlbumArticle | ArtistArticle | BandArticle
 * @var $model User
 */

use common\models\AlbumArticle;
use common\models\ArtistArticle;
use common\models\BandArticle;
use common\models\User;
use yii\helpers\Html;

?>

<span class="material-symbols-rounded !text-lg xl:!text-xl">
    feed
</span>
<p>
    <?= $model->username . ' wrote article for ' ?>
    <?php
    if ($contrib instanceof AlbumArticle) $elemType = 'album';
    elseif ($contrib instanceof ArtistArticle) $elemType = 'artist';
    elseif ($contrib instanceof BandArticle) $elemType = 'band';

    echo $elemType . ' called ' . Html::a(
            $contrib->{$elemType}->title ?? $contrib->{$elemType}->name,
            [$elemType . '/view', 'slug' => $contrib->{$elemType}->slug],
            ['class' => 'italic text-main-accent hover:underline']
        ); ?>
    <span class="text-gray-500 italic hidden md:inline">
        + 5 points
    </span>
</p>
