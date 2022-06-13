<?php
/**
 * @var $model Album
 */

use common\models\Album;
use yii\helpers\Url;

if ($model->artist_id) $author = $model->artist;
else $author = $model->band;

?>

<div class="group">

    <a href="<?php echo Url::to([
        '/album/view',
        'slug' => $model->slug,
    ]) ?>"
    >

        <img src="<?php echo $model->artwork_url ?>" alt="Album artwork"
             class="shadow-lg group-hover:scale-95 transition-transform ease-in-out">
    </a>

    <div class="flex flex-col gap-0 p-2 truncate">
        <p class="text-md lg:text-lg truncate">
            <a href="<?php echo Url::to([
                '/album/view',
                'slug' => $model->slug,
            ]) ?>"
               class="hover:underline transition underline-offset-2"
               title="<?php echo $model->title ?>">
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

