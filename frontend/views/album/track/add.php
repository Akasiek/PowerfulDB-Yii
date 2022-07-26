<?php
/**
 * @var $model Track
 * @var $album Album
 */

use common\models\Album;
use common\models\Track;

$this->title = 'Add Track';
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 max-w-lg lg:max-w-3xl mx-auto w-full">

    <h1 class="form-title mb-6 mb:mb-10 w-full">Add track to <?= $album->title ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
