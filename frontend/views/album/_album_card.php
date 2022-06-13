<?php
/**
 * @var $model Album
 */

use common\models\Album;
use yii\helpers\Url;

if ($model->artist_id) $author = $model->artist;
else $author = $model->band;

?>

<div class="truncate">

    <a href="<?php echo Url::to([
        '/album/view',
        'slug' => $model->slug,
        'author_slug' => $author->slug
    ]) ?>">
        <img src="<?php echo $model->artwork_url ?>" alt="Album artwork">
    </a>

    <div class="flex flex-col gap-0 p-2">
        <p class="text-xl truncate">
            <a href="<?php echo Url::to([
                '/album/view',
                'slug' => $model->slug,
                'author_slug' => $author->slug
            ]) ?>"
               class="hover:underline transition underline-offset-2">
                <?php echo $model->title ?>
            </a>
        </p>

        <p class="text-sm truncate italic">
            <a href="<?php echo Url::to([
                '/' . ($model->artist_id ? 'artist' : 'band') . '/view/',
                'slug' => $author->slug
            ]) ?>"
               class="hover:underline transition">
                <?php echo $author->name ?>
            </a>
        </p>
    </div>
</div>

