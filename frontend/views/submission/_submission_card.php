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
        echo Html::a(
            ($model->table === "album" ? $element->title : $element->name),
            [$model->table . '/view', 'slug' => $element->slug]);
    } ?>
    <p><?= $model->old_data ?: "null" ?></p>
    <p><?= $model->new_data ?: "null" ?></p>
    <?= Html::a($model->user->username, ['user/view', 'id' => $model->user->id]) ?>
    <?= Html::a('visibility', [
        'submission/view',
        'id' => $model->id,
    ], ['class' => 'material-symbols-outlined']) ?>
</div>
