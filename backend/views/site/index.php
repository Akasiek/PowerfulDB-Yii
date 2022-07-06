<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index row">
    <div class="col d-flex flex-column">
        <a href="<?php echo \yii\helpers\Url::to('/backend/artist') ?>" class="btn btn-primary m-2">Artist Panel</a>
        <a href="<?php echo \yii\helpers\Url::to('/backend/artist-article') ?>" class="btn btn-primary m-2">Artist Article
            Panel</a>
    </div>

    <div class="col d-flex flex-column">
        <a href="<?php echo \yii\helpers\Url::to('/backend/band') ?>" class="btn btn-primary m-2">Band Panel</a>
        <a href="<?php echo \yii\helpers\Url::to('/backend/band-article') ?>" class="btn btn-primary m-2">Band Article Panel</a>
        <a href="<?php echo \yii\helpers\Url::to('/backend/band-member') ?>" class="btn btn-primary m-2">Band Member Panel</a>
    </div>

    <div class="col d-flex flex-column">
        <a href="<?php echo \yii\helpers\Url::to('/backend/album') ?>" class="btn btn-primary m-2">Album Panel</a>
        <a href="<?php echo \yii\helpers\Url::to('/backend/album-article') ?>" class="btn btn-primary m-2">Album Article
            Panel</a>
        <a href="<?php echo \yii\helpers\Url::to('/backend/album-genre') ?>" class="btn btn-primary m-2">Album Genre
            Panel</a>
        <a href="<?php echo \yii\helpers\Url::to('/backend/track') ?>" class="btn btn-primary m-2">Album Track
            Panel</a>
    </div>
    <div class="col d-flex flex-column">
        <a href="<?php echo \yii\helpers\Url::to('/backend/genre') ?>" class="btn btn-primary m-2">Genre Panel</a>
    </div>
</div>