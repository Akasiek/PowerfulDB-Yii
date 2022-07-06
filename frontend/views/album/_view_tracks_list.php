<?php

/** 
 * @var $model Album
 */

use common\models\Album;
use yii\helpers\Html;

// Fetch tracks of this album from Track table
$tracks = $model->getTracks()->all();

// Calculate full length of an album
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
?>

<?php if (!empty($tracks)) : ?>

    <div>
        <div class="flex items-center gap-4">
            <h1 class="font-sans text-5xl">Albums</h1>
            <?php if (!Yii::$app->user->isGuest) {
                echo Html::a(
                    'add',
                    ['/album/track-add', Yii::$app->controller->id . '_id' => $model->id],
                    ['class' => 'material-symbols-rounded text-secondary-dark p-0.5 rounded-full bg-main-accent']
                );
            } ?>
        </div>
        <hr class="max-w-sm  border-t-2 border-t-main-accent mt-2 mb-6">

        <div class=" gap-x-10">
            <?php foreach ($tracks as $index => $track) : ?>
                <div class="flex justify-between">

                    <p class="">
                        <?= $track->position . '. ' ?>
                        <span class="font-bold"><?= $track->title ?></span>
                    </p>
                    <p class="w-auto italic text-gray-300">
                        <?php
                        $duration = explode(':', $track->duration);
                        if ($duration[0] !== '00') echo $duration[0] . ':';
                        echo $duration[1] . ':' . $duration[2];
                        ?>
                    </p>
                </div>

                <hr class="my-4 border-t-2  border-t-gray-700 ">

            <?php endforeach; ?>
        </div>
        <p class="italic text-gray-400">
            Album's full length: <span class="text-main-light"><?= $fullLength ?></span>
        </p>

    </div>

<?php else : ?>

<?php endif; ?>