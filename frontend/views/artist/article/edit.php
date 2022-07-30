<?php

/**
 * @var $model ArtistArticle
 */

use common\models\ArtistArticle;

$this->title = 'Edit Artist Article';
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex justify-center items-center">
    <?= $this->render('@frontend/views/components/_form_article', [
        'model' => $model
    ]) ?>
</div>
