<?php

/** 
 * @var $model User
 */

use common\models\User;
use common\models\Album;
use common\models\AlbumGenre;
use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;

$arrayDataProvider = $model->getContributions();

// Make array of all contributions using date as key.
// This way all contributions can be grouped in according arrays.
$contribs = [];

foreach ($arrayDataProvider->getModels() as $contrib) {
    $contribs[$contrib->created_date][] = $contrib;
}



// echo '<pre>';
// print_r($contribs);
// foreach ($contrib as $date => $dateContrib) {
// foreach ($dateContrib as $value) {
// echo $date . ': ' . ($value instanceof Album ? $value->title : $value->name)  . '<br>';
// }
// }
// echo '</pre>';
// exit;
?>

<div class="flex-1 lg:min-w-[26rem]">
    <div>
        <h1 class="font-sans text-2xl xl:text-3xl">Latest contributions</h1>
        <hr class="border-t-2 border-t-main-accent">

        <?php foreach ($contribs as $date => $dateContribs) : ?>
            <div class="">
                <h4 class="italic xl:text-lg mt-8 mb-2"><?= Yii::$app->formatter->asDate($date, 'long'); ?></h4>

                <div class="flex flex-col gap-6">
                    <?php foreach ($dateContribs as $contrib) : ?>

                        <?= $this->render('_view_render_contrib', [
                            'contrib' => $contrib,
                            'model' => $model,
                        ]); ?>

                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <?php
        echo \yii\widgets\LinkPager::widget(
            [
                'pagination' => $arrayDataProvider->pagination,
                'options' => [
                    'class' => 'mt-12 flex rounded-lg bg-main-dark w-fit overflow-hidden absolute right-0 left-0 mx-auto',
                ],
                'linkOptions' => [
                    'class' => 'flex justify-center items-center py-3 px-4',
                ],
                'pageCssClass' => 'flex hover:opacity-60',
                'disabledPageCssClass' => 'py-3 px-4 text-gray-500',
                'activePageCssClass' => 'bg-secondary-accent',
                'maxButtonCount' => 6,
            ],
        );
        ?>
    </div>
</div>