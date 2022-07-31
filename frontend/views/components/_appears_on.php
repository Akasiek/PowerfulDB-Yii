<?php
/**
 * @var $model Artist | Band
 */

use common\models\Artist;
use common\models\Band;

$albumsAppearedOn = $model->getAlbumsAppearedOn();

$dataProvider = new \yii\data\ActiveDataProvider([
    'query' => $albumsAppearedOn,
    'pagination' => [
        'pageSize' => 10,
    ],
]);
?>
<?php if (count($dataProvider->getModels()) > 0) : ?>
    <div>
        <h1 class="section-title">Appears On</h1>
        <hr class="section-hr">
        <?= $this->render('@frontend/views/album/_album_swiper', [
            'dataProvider' => $dataProvider,
            'location' => 'view',
        ]) ?>
    </div>
<?php endif; ?>