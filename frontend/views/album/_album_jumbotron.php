<?php
/**
 * @var $model Album
 * @var $author Artist | Band
 */

use common\models\Album;
use common\models\Artist;
use common\models\Band;

?>

<div class="flex mt-16 justify-center w-full">

    <div class="flex justify-center items-center gap-5 xl:gap-10 max-w-screen-xl px-16">
        <div>
            <img src="<?php echo $model->artwork_url ?>" alt="Album artwork" class="w-96">
        </div>
        <div class="flex flex-col gap-2">

            <a href="<?php echo \yii\helpers\Url::to([
                '/' . ($model->artist_id ? 'artist' : 'band') . '/view/',
                'slug' => $author->slug
            ]) ?>" class="hover:underline">
                <h3 class="text-lg lg:text-2xl"><?php echo $author->name ?></h3>
            </a>

            <h1 class="text-2xl lg:text-5xl font-bold"><?php echo $model->title ?></h1>

            <p class="text-gray-400 text-sm lg:text-base">
                <?php
                if (isset($model->release_date)) {
                    echo Yii::$app->formatter->asDate($model->release_date, 'long');
                }
                ?>
            </p>

            <p class="italic text-sm lg:text-base">
                <?php
                // TODO: Genres
                echo 'Heavy Metal • Hard Rock';
                ?>
            </p>

        </div>
    </div>

</div>
