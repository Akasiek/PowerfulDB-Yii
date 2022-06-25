<?php
/**
 * @var $sort Sort
 */

use yii\data\Sort;
use yii\helpers\Html;

$founding_from_year = Yii::$app->request->get('founding_from_year');
$founding_to_year = Yii::$app->request->get('founding_to_year');
$break_up_from_year = Yii::$app->request->get('break_up_from_year');
$break_up_to_year = Yii::$app->request->get('break_up_to_year');

?>

<div>
    <?= Html::beginForm(['/band'], 'get'); ?>

    <div class="flex items-center  flex-wrap justify-between gap-5 mb-10 mt-[-1rem]">

        <div class="flex items-center  gap-10">
            <div class="flex flex-col justify-center gap-2">
                <p>Sort</p>
                <div>
                    <?php
                    $sortValue = key($sort->getAttributeOrders());
                    if (array_values($sort->getAttributeOrders())[0] == 3) {
                        $sortValue = '-' . $sortValue;
                    }

                    echo Html::dropDownList('sort', $sortValue, [
                        'name' => 'Name Ascending',
                        '-name' => 'Name Descending',
                        'founding_year' => 'Created Last',
                        '-founding_year' => 'Created First',
                    ], [
                        'class' => 'input-style m-0 !py-2',
                        'id' => 'select-slim',
                        'onchange' => 'this.form.submit()',
                    ]) ?>
                </div>
            </div>

            <div class="flex flex-col justify-center gap-2">
                <p>Formation year:</p>
                <div class="flex w-fit gap-1 border-2 border-main-accent rounded-3xl px-3 py-1">

                    <input type="number" name="founding_from_year" value="<?= $founding_from_year ?>"
                           class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                           min="1900" max="2099" placeholder="1900">

                    <p>-</p>

                    <input type="number" name="founding_to_year" value="<?= $founding_to_year ?>"
                           class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                           min="1900" max="2099" placeholder="<?= date('Y') ?>">
                </div>

            </div>

            <div class="flex flex-col justify-center gap-2">
                <p>Break up year:</p>
                <div class="flex w-fit gap-1 border-2 border-main-accent rounded-3xl px-3 py-1">

                    <input type="number" name="break_up_from_year" value="<?= $break_up_from_year ?>"
                           class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                           min="1900" max="2099" placeholder="1900">

                    <p>-</p>

                    <input type="number" name="break_up_to_year" value="<?= $break_up_to_year ?>"
                           class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                           min="1900" max="2099" placeholder="<?= date('Y') ?>">
                </div>

            </div>
        </div>

        <div class="flex gap-5">
            <input type="submit" value="Filter" class="btn-style">
            <?= Html::a('Reset', ['/band'], ['class' => 'btn-style']) ?>
        </div>

        <?= Html::endForm() ?>
    </div>