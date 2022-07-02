<?php

/** 
 * @var $model Artist | Album
 * @var $type
 */

use common\models\Artist;
use common\models\Album;
use yii\helpers\Url;
?>

<a href="<?= Url::to([
                $model instanceof Artist ? ('/artist/view') : ('/album/view'),
                'slug' => $model->slug
            ]) ?>">
    <div class="relative flex items-end h-44 overflow-hidden rounded-2xl">

        <?php
        echo "<img";
        if ($model instanceof Artist) {
            echo " src=" . $model->bg_image_url . " alt=" . $model->name . " background image";
        } elseif ($model instanceof Album) {
            echo " src=" . $model->artwork_url . " alt=" . $model->title . " artwork image";
        }
        echo " class=\"absolute z-0 top-0 left-0 h-full w-full object-center object-cover\" />";
        ?>

        <div class="absolute top-0 bottom-0 left-0 right-0 " style="background: linear-gradient(180deg, rgba(94, 43, 255, 0) 30%, rgba(94, 43, 255, 0.75) 100%);"></div>

        <div class="z-10 my-4 mx-6">
            <?php if ($type === 'birthday') : ?>

                <p class="text-lg drop-shadow-md font-bold">
                    <?= $model->name ?> was born <?= date('Y') - date('Y', strtotime($model->birth_date)) ?> years ago
                </p>

            <?php elseif ($type === 'death_anniversary') : ?>

                <p class="text-lg drop-shadow-md font-bold">

                    <?php
                    // If artist died year ago then type "Artist died a year ago", else "Artist died X years ago"
                    if (date('Y') - date('Y', strtotime($model->death_date)) === 1) {
                        echo $model->name . ' died a year ago';
                    } else {
                        echo $model->name . ' died ' . date('Y') - date('Y', strtotime($model->death_date)) . ' years ago';
                    }
                    ?>
                </p>

            <?php elseif ($type === 'album_anniversary') : ?>

                <p class="text-lg drop-shadow-md font-bold">
                    <?php
                    // If album was released year ago then type "Album was released a year ago", else "Album was released X years ago"
                    if (date('Y') - date('Y', strtotime($model->release_date)) === 1) {
                        echo $model->title . ' was released a year ago';
                    } else {
                        echo $model->title . ' was released ' . date('Y') - date('Y', strtotime($model->release_date)) . ' years ago';
                    }
                    ?>
                </p>

            <?php endif; ?>
        </div>

    </div>
</a>