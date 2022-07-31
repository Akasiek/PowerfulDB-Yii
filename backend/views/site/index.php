<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div>
    Today is <?= date('Y-m-d') ?>
</div>
<div class="site-index row">
    <div class="col d-flex flex-column">
        <a href="<?php echo Url::to('/backend/user') ?>" class="btn btn-primary mx-0.5 my-1">User Panel</a>
    </div>

    <div class="col d-flex flex-column">
        <a href="<?php echo Url::to('/backend/artist') ?>"
           class="btn btn-primary mx-0.5 my-1">Artist Panel</a>

        <a href="<?php echo Url::to('/backend/artist-article') ?>"
           class="btn btn-primary mx-0.5 my-1">Artist Article Panel</a>
    </div>

    <div class="col d-flex flex-column">
        <a href="<?php echo Url::to('/backend/band') ?>"
           class="btn btn-primary mx-0.5 my-1">Band Panel</a>

        <a href="<?php echo Url::to('/backend/band-article') ?>"
           class="btn btn-primary mx-0.5 my-1">Band Article Panel</a>

        <a href="<?php echo Url::to('/backend/band-member') ?>"
           class="btn btn-primary mx-0.5 my-1">Band Member Panel</a>
    </div>

    <div class="col d-flex flex-column">
        <a href="<?php echo Url::to('/backend/album') ?>"
           class="btn btn-primary mx-0.5 my-1">Album Panel</a>

        <a href="<?php echo Url::to('/backend/album-article') ?>"
           class="btn btn-primary mx-0.5 my-1">Album Article Panel</a>

        <a href="<?php echo Url::to('/backend/album-genre') ?>"
           class="btn btn-primary mx-0.5 my-1">Album Genre Panel</a>

        <a href="<?php echo Url::to('/backend/track') ?>"
           class="btn btn-primary mx-0.5 my-1">Album Track Panel</a>

        <a href="<?php echo Url::to('/backend/featured-author') ?>"
           class="btn btn-primary mx-0.5 my-1">Track Featured Author Panel</a>

    </div>

    <div class="col d-flex flex-column">
        <a href="<?php echo Url::to('/backend/genre') ?>" class="btn btn-primary mx-0.5 my-1">Genre Panel</a>
    </div>

    <div class="col d-flex flex-column">
        <a href="<?php echo Url::to('/backend/auth-assignment') ?>"
           class="btn btn-primary mx-0.5 my-1">Auth Assignment</a>
        
        <a href="<?php echo Url::to('/backend/auth-item') ?>"
           class="btn btn-primary mx-0.5 my-1">Auth Item</a>

        <a href="<?php echo Url::to('/backend/auth-item-child') ?>"
           class="btn btn-primary mx-0.5 my-1">Auth Item Child</a>

        <a href="<?php echo Url::to('/backend/auth-rule') ?>"
           class="btn btn-primary mx-0.5 my-1">Auth Rule</a>
    </div>
</div>