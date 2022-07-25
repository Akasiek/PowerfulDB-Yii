<?php
/**
 * @var $model EditSubmission
 * @var $element Album | null
 */

use common\models\Album;
use common\models\EditSubmission;
use yii\helpers\Html;

$this->title = "Edit " . ($model->table === "album" ? $element->title : $element->name);
?>

<div class="w-full mx-auto px-6 lg:px-14 py-8">
    <div class="flex flex-col gap-2 mb-4 md:text-lg xl:text-xl">
        <p>
            <i class="text-gray-400">Table:</i> <?= $model->table ?>
        </p>
        <p>
            <i class="text-gray-400">Column:</i> <?= $model->column ?>
        </p>
        <p>
            <i class="text-gray-400">Element:</i>
            <?= Html::a(
                ($model->table === "album" ? $element->title : $element->name),
                ['album/view', 'slug' => $element->slug],
                ['class' => 'text-main-accent hover:underline',]) ?>
        </p>
        <p>
            <i class="text-gray-400">Old Data:</i> <?= $model->old_data ?>
        </p>
        <p>
            <i class="text-gray-400">New Data:</i> <?= $model->new_data ?>
        </p>
        <p>
            <i class="text-gray-400">Editor:</i>
            <?= Html::a($model->user->username, ['user/view', 'id' => $model->user->id], [
                'class' => 'text-main-accent hover:underline',
            ]) ?>
        </p>
        <p>
            <i class="text-gray-400">Status:</i> <?= $model->status ?>
            (<?= array_search($model->status, EditSubmission::STATUSES) ?>)
        </p>
    </div>

    <div class="flex gap-4">
        <?= Html::a('Approve', [
            'submission/approve',
            'id' => $model->id,
        ], ['class' => 'btn-style']) ?>

        <?= Html::a('Reject', [
            'submission/reject',
            'id' => $model->id,
        ], ['class' => 'btn-style']) ?>
    </div>
</div>
