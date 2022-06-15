<?php
/**
 * @var $model Band
 */

use common\models\Band;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

// Wierd fix for pjax to not scroll to top
$this->registerJs('$.pjax.defaults.scrollTo = false;', \yii\web\View::POS_LOAD);

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