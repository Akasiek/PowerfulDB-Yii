<?php
/**
 * @var $model EditSubmission
 */

use common\models\Album;
use common\models\EditSubmission;
use common\models\User;
use yii\helpers\Html;

$element = $model->getElement();
?>

<div class="submission-table-row">
    <p><?= $model->table . '[' . $model->column . ']' ?></p>
    <?php if (isset($element)) {
        echo Html::a($element->title, ['album/view', 'slug' => $element->slug]);
    } ?>
    <p><?= $model->old_data ?></p>
    <p><?= $model->new_data ?></p>
    <?= Html::a($model->user->username, ['user/view', 'id' => $model->user->id]) ?>
    <?= Html::a('visibility', [
        'submission/view',
        'id' => $model->id,
    ], ['class' => 'material-symbols-outlined']) ?>
</div>
