<?php
/**
 * @var $model EditSubmission
 */

use common\models\EditSubmission;
use yii\helpers\Html;

$element = $model->getElement();
?>

<div class="submission-table-row">
    <p><?= $model->table . ' [' . $model->column . ']' ?></p>
    <?php if (isset($element)) {
        if ($model->table !== "track" && $model->table !== "featured_author") {
            echo Html::a(
                ($model->table === "album" ? $element->title : $element->name),
                [$model->table . '/view', 'slug' => $element->slug]);
        } else {
            echo '<p>' . $element->title . '</p>';
        }
    } ?>
    <?php if (isset($model->jsonString)): ?>
        <p><?= $model->jsonString['old'] ?></p>
        <p><?= $model->jsonString['new'] ?></p>
    <?php else: ?>
        <p><?= $model->new_data ?: "null" ?></p>
        <p><?= $model->old_data ?: "null" ?></p>
    <?php endif; ?>

    <?= Html::a($model->user->username, ['user/view', 'id' => $model->user->id]) ?>
    <?= Html::a('visibility', [
        'submission/view',
        'id' => $model->id,
    ], ['class' => 'material-symbols-outlined']) ?>
</div>
