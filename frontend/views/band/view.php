<?php
/**
 * @var $model Band
 */

use common\models\Band;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\widgets\Pjax;

// Wierd fix for pjax to not scroll to top
$this->registerJs('$.pjax.defaults.scrollTo = false;', \yii\web\View::POS_LOAD);

if (!isset($model)) throw new NotFoundHttpException('Band not found');

?>

<?php
echo $this->render('@frontend/views/components/_default_jumbotron', [
    'model' => $model,
]);
?>

<div class="flex flex-col justify-center items-center mt-5">
    <div class="px-14 py-8 max-w-screen-lg w-full">

        <div class="mb-16">
            <?= $this->render('@frontend/views/components/_render_article', [
                'model' => $model,
            ]); ?>
        </div>

        <div>
            <?= $this->render('_band_members', [
                'model' => $model,
            ]); ?>
        </div>

        <?= $this->render('@frontend/views/components/_author_albums', [
            'model' => $model,
        ]); ?>
    </div>
</div>