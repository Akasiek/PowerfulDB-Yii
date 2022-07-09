<?php

/**
 * @var $sort Sort
 */

use yii\data\Sort;
use yii\helpers\Html;

$from_year = Yii::$app->request->get('from_year');
$to_year = Yii::$app->request->get('to_year');
$genre = Yii::$app->request->get('genre');

?>

<div>
    <?= Html::beginForm(['/album/'], 'get'); ?>
    <div class="flex items-center flex-wrap justify-between gap-5 mb-10 mt-[-1rem]">

        <div class="flex items-center flex-wrap gap-x-8 gap-y-5">
            <div>
                <?php
                $sortValue = key($sort->getAttributeOrders());
                if (array_values($sort->getAttributeOrders())[0] == 3) {
                    $sortValue = '-' . $sortValue;
                }


                echo Html::dropDownList('sort', $sortValue, [
                    'title' => 'Title Ascending',
                    '-title' => 'Title Descending',
                    'release_date' => 'Oldest First',
                    '-release_date' => 'Newest First',
                ], [
                    'class' => 'input-style m-0 !py-2',
                    'id' => 'select-slim',
                    'onchange' => 'this.form.submit()',
                ]) ?>
            </div>


            <div class="flex md:flex-col items-center md:items-start justify-center gap-2">
                <p>Release year:</p>
                <div class="flex gap-1 border-2 border-main-accent rounded-3xl px-3 py-1">

                    <input type="number" name="from_year" value="<?= $from_year ?>" class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600" min="1900" max="2099" placeholder="1900">

                    <p>-</p>

                    <input type="number" name="to_year" value="<?= $to_year ?>" class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600" min="1900" max="2099" placeholder="<?= date('Y') ?>">
                </div>

            </div>

            <div class="flex md:flex-col items-center md:items-start justify-center gap-2">
                <p>Genre:</p>
                <div class="flex gap-1 border-2 border-main-accent rounded-3xl px-3 py-1">

                    <input type="text" name="genre" value="<?= $genre ?>" class="w-28 bg-transparent focus:outline-0
                   placeholder:text-gray-600" placeholder="Rock">

                </div>

            </div>
        </div>

        <div class="flex gap-5 ml-auto">
            <input type="submit" value="Filter" class="btn-style">
            <?= Html::a('Reset', ['/album/'], ['class' => 'btn-style']) ?>
        </div>
    </div>

    <?= Html::endForm() ?>
</div>