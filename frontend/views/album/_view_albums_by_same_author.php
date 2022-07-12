<?php

/** 
 * @var $model Album
 */

use \common\models\Album;

// Fetch all others albums by the same artist or band
if ($model->artist_id) {
    $albums = Album::find()
        ->andWhere(['artist_id' => $model->artist_id])
        ->andWhere(['!=', 'id', $model->id])
        ->orderBy('release_date DESC')
        ->all();
} else {
    $albums = Album::find()
        ->andWhere(['band_id' => $model->band_id])
        ->andWhere(['!=', 'id', $model->id])
        ->orderBy('release_date DESC')
        ->all();
}
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $albums,
]);
?>

<div>
    <h1 class="section-title">Albums by the same author</h1>
    <hr class="section-hr">
    <?= $this->render('_album_swiper', [
        'dataProvider' => $dataProvider,
    ]); ?>
</div>