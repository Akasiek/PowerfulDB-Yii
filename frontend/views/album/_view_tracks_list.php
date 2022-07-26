<?php

/**
 * @var $model Album
 */

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;
use yii\helpers\Url;

// Fetch tracks of this album from Track table
$tracks = $model->getTracks()->with(['featuredAuthors'])->all();

// Calculate full length of an album
function fullLength($tracks)
{
    $length = ['hours' => 0, 'minutes' => 0, 'seconds' => 0];
    foreach ($tracks as $track) {
        $d = explode(':', $track->duration);
        $length['hours'] += $d[0];
        $length['minutes'] += $d[1];
        $length['seconds'] += $d[2];
    }
    $length['minutes'] += intdiv($length['seconds'], 60);
    $length['seconds'] = $length['seconds'] % 60;
    $length['hours'] += intdiv($length['minutes'], 60);
    $length['minutes'] = $length['minutes'] % 60;

    $fullLength = '';
    if ($length['hours'] > 0) {
        $fullLength .= $length['hours'] . ($length['hours'] === 1 ? ' hour ' : ' hours ');
    }
    $fullLength .= $length['minutes'] . ($length['minutes'] === 1 ? ' minute ' : ' minutes ');
    $fullLength .= $length['seconds'] . ($length['seconds'] === 1 ? ' seconds' : ' seconds');
    return $fullLength;
}

$length = fullLength($tracks);
?>


<div>

    <div class="flex items-center gap-2 md:gap-4">
        <h1 class="section-title">Tracks</h1>
        <?php if (!Yii::$app->user->isGuest) {
            echo Html::a(
                'add',
                ['track-add', 'slug' => $model->slug],
                ['class' => 'material-symbols-rounded text-secondary-dark scale-90 md:scale-100 md:p-0.5 rounded-full bg-main-accent']
            );
        } ?>
    </div>

    <hr class="section-hr">

    <?php if (!empty($tracks)) : ?>
        <div>
            <?php foreach ($tracks as $index => $track) : ?>
                <div class="flex justify-between text-sm md:text-base gap-4 items-center">

                    <p>
                        <?= $track->position . '. ' ?>
                        <span class="font-bold"><?= $track->title ?></span>
                        <?php if (!empty($track->featuredAuthors)) : ?>
                            <span class="text-gray-400">
                                feat.
                                <?php foreach ($track->featuredAuthors as $index => $author) {
                                    // Find artist or band
                                    if ($author->artist_id) $authorModel = Artist::findOne($author->artist_id);
                                    else $authorModel = Band::findOne($author->band_id);
                                    // Print author name as a link to their page
                                    echo Html::a(
                                        $authorModel->name,
                                        Url::to(['/' . ($authorModel instanceof Artist ? 'artist' : 'band') . '/view', 'slug' => $authorModel->slug]),
                                        ['class' => 'hover:underline']
                                    );
                                    // Put comma after author name except last author
                                    if ($index < count($track->featuredAuthors) - 1) echo ', ';
                                } ?>
                        </span>
                        <?php endif; ?>
                    </p>
                    <p class="w-auto italic text-gray-300 flex gap-1 items-center">
                        <?php
                        $duration = explode(':', $track->duration);
                        if ($duration[0] !== '00') echo $duration[0] . ':';
                        echo $duration[1] . ':' . $duration[2];
                        ?>
                        <?php if (!Yii::$app->user->isGuest) {
                            echo Html::a(
                                'edit',
                                ['track-edit', 'albumSlug' => $model->slug, 'trackSlug' => $track->slug],
                                ['class' => 'material-symbols-outlined text-gray-600 h-full !text-lg !leading-none']
                            );
                        } ?>
                    </p>

                </div>

                <hr class="my-3 md:my-4 border-t-1  border-t-gray-700 ">

            <?php endforeach; ?>
        </div>
        <p class="italic text-gray-400 text-sm md:text-base">
            Album's full length: <span class="text-main-light"><?= $length ?></span>
        </p>

    <?php else : ?>

        <p class="text-sm md:text-base">
            Album has no tracks yet.
            <?php if (!Yii::$app->user->isGuest) : ?>
                You can go ahead and
                <a href="<?= Url::to(['/album/track-create', 'slug' => $model->slug]) ?>"
                   class="text-main-accent hover:underline">
                    add tracks here
                </a>
            <?php else : ?>
                <?= Html::a(
                    'Log in to add them',
                    ['/login'],
                    ['class' => 'hover:underline text-main-accent']
                ) ?>
            <?php endif; ?>
        </p>

    <?php endif; ?>
</div>