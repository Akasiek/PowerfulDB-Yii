<?php
/**
 * @var $model Artist
 */

use common\models\Artist;

?>


<?php
echo $this->render('@frontend/views/components/_default_jumbotron', [
    'model' => $model,
]);
?>

<div class="flex flex-col justify-center items-center mt-5">
    <div class="px-14 py-8 w-full ">
        <!-- TODO: ARTIST ARTICLE -->

        <?= $this->render('@frontend/views/components/_author_albums', [
            'model' => $model,
        ]); ?>
    </div>
</div>
