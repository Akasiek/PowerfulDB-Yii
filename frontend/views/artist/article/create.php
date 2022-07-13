<?php

/**
 * @var $model ArtistArticle
 */

use common\models\ArtistArticle;

$this->title = 'Create Artist Article';
?>

<div class="py-14 px-20 max-w-screen-lg w-full m-auto flex justify-center items-center">
    <?= $this->render('@frontend/views/components/_form_article', [
        'model' => $model
    ]) ?>
</div>