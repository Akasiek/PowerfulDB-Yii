<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index d-flex gap-3">
    <div class="pr-2">
        <a href="<?php echo \yii\helpers\Url::to('/artist') ?>" class="btn btn-primary">Artist Panel</a>
    </div>

    <div class="pr-2">
        <a href="<?php echo \yii\helpers\Url::to('/band') ?>" class="btn btn-primary">Band Panel</a>
    </div>

    <div>
        <a href="<?php echo \yii\helpers\Url::to('/album') ?>" class="btn btn-primary">Album Panel</a>
    </div>
</div>
