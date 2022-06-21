<?php
/**
 * @var $dataProvider ActiveDataProvider
 */

use yii\data\ActiveDataProvider;

?>
<div class="px-14 py-8">

    <?php echo $this->render('@frontend/views/components/_index_page_title') ?>

    <?php echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '@frontend/views/components/_default_card',
        'layout' => '<div class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-12">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false,
        ],
    ]) ?>

</div>
