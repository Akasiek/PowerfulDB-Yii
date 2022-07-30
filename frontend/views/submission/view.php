<?php
/**
 * @var $model EditSubmission
 * @var $element Album | null
 */

use common\models\Album;
use common\models\EditSubmission;
use yii\helpers\Html;

$this->title = "Edit Submission";

include Yii::getAlias('@frontend/web/jsonString.php');
jsonString($model);
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
            <?php if ($model->table === 'track') : ?>
                <?= $element->title ?>
            <?php elseif ($model->table === 'band_member'): ?>
                <?= Html::a(
                    $element->artist->name ?? $element->name,
                    ['/band/view', 'slug' => $element->band->slug, '#' => 'members'],
                    ['class' => 'text-main-accent']
                ) ?>
            <?php elseif (in_array($model->table, ['album_article', 'band_article', 'artist_article'])): ?>
                <?php
                $table = explode('_', $model->table);
                echo Html::a(
                    $element->{$table[0]}->name ?? $element->{$table[0]}->title,
                    ['/' . $table[0] . '/view', 'slug' => $element->{$table[0]}->slug],
                    ['class' => 'text-main-accent hover:underline',]
                ) ?>
            <?php else : ?>
                <?= Html::a(
                    ($model->table === 'album' ? $element->title : $element->name),
                    ['album/view', 'slug' => $element->slug],
                    ['class' => 'text-main-accent hover:underline',]) ?>
            <?php endif ?>

        </p>
        <?php if (isset($model->jsonString)): ?>
            <p>
                <i class="text-gray-400">Old Data:</i> <?= $model->jsonString['old'] ?>
            </p>
            <p>
                <i class="text-gray-400">New Data:</i> <?= $model->jsonString['new'] ?>
            </p>
        <?php elseif (!$model->new_article && !$model->old_article): ?>
            <p>
                <i class="text-gray-400">Old Data:</i> <?= $model->old_data ?>
            </p>
            <p>
                <i class="text-gray-400">New Data:</i> <?= $model->new_data ?>
            </p>
        <?php endif; ?>
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

    <?php if ($model->column === "delete") : ?>
        <p class="mb-4">
            <span class="text-red-500">Warning:</span>
            Approving this submission means permanent deletion of a record. Approve if you're 100% sure!
        </p>
    <?php endif; ?>

    <?php if ($model->new_article && $model->old_article): ?>
        <h1 class="text-3xl text-center">New Article</h1>
        <article class="mx-auto prose prose-invert lg:prose-xl w-full text-justify overflow-hidden mb-20">
            <?= $model->new_article ?>
        </article>
        <h1 class="text-3xl text-center">Old Article</h1>
        <article class="mx-auto prose prose-invert lg:prose-xl w-full text-justify overflow-hidden">
            <?= $model->old_article ?>
        </article>
    <?php endif; ?>

    <div class="flex gap-4">
        <?= Html::a('Approve', [
            'submission/approve',
            'id' => $model->id,
        ], ['class' => 'btn-style']) ?>

        <?= Html::a('Reject', [
            'submission/reject',
            'id' => $model->id,
        ], ['class' => 'btn-style-warning']) ?>
    </div>
</div>
