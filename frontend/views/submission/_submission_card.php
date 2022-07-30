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
        if ($model->table === 'track' && $model->table === 'featured_author') {
            echo '<p>' . $element->title . '</p>';
        } elseif ($model->table === 'band_member') {
            echo Html::a(
                $element->artist->name ?? $element->name,
                ['/band/view', 'slug' => $element->band->slug, '#' => 'members'],
                ['class' => 'text-main-accent']
            );
        } else {
            echo Html::a(
                ($model->table === "album" ? $element->title : $element->name),
                [$model->table . '/view', 'slug' => $element->slug]);
        }
    } ?>
    <?php if (isset($model->jsonString)): ?>
        <p><?= $model->jsonString['old'] ?></p>
        <p><?= $model->jsonString['new'] ?></p>
    <?php else: ?>
        <p><?= $model->old_data ?: "null" ?></p>
        <p><?= $model->new_data ?: "null" ?></p>
    <?php endif; ?>

    <?= Html::a($model->user->username, ['user/view', 'id' => $model->user->id]) ?>
    <?= Html::a('visibility', [
        'submission/view',
        'id' => $model->id,
    ], ['class' => 'material-symbols-outlined']) ?>
</div>
