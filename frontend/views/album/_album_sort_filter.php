<?php

use yii\helpers\Html;

$from_year = Yii::$app->request->get('from_year');
$to_year = Yii::$app->request->get('to_year');
?>

<div>
    <?= Html::beginForm(['/album/'], 'get'); ?>
    <div class="flex items-center justify-between mb-10 mt-[-1rem]">
        <div class="flex flex-col justify-center gap-2">
            <p>Release year:</p>
            <div class="flex gap-1 border-2 border-main-accent rounded-3xl px-3 py-1">

                <input type="number" name="from_year" value="<?= $from_year ?>"
                       class="bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                       min="1900" max="2099" placeholder="1900">

                <p>-</p>

                <input type="number" name="to_year" value="<?= $to_year ?>"
                       class="bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                       min="1900" max="2099" placeholder="<?= date('Y') ?>">
            </div>

        </div>

        <div class="flex gap-5">
            <input type="submit" value="Filter" class="btn-style w-24">
            <?= Html::a('Reset', ['/album/'], ['class' => 'btn-style w-24']) ?>
        </div>
    </div>

    <?= Html::endForm() ?>
</div>
