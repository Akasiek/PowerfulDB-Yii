<?php
/**
 * @var $sort Sort
 */

use yii\data\Sort;
use yii\helpers\Html;

$birth_from_year = Yii::$app->request->get('birth_from_year');
$birth_to_year = Yii::$app->request->get('birth_to_year');
$death_from_year = Yii::$app->request->get('death_from_year');
$death_to_year = Yii::$app->request->get('death_to_year');

?>

<div>
    <?=Html::beginForm(['/artist/'], 'get');?>

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
    'birth_date' => 'Oldest First',
    '-birth_date' => 'Youngest First',
], [
    'class' => 'input-style m-0 !py-2',
    'id' => 'select-slim',
    'onchange' => 'this.form.submit()',
])?>
                </div>
            </div>

            <div class="flex flex-col justify-center gap-2">
                <p>Birth year:</p>
                <div class="flex w-fit gap-1 border-2 border-main-accent rounded-3xl px-3 py-1">

                    <input type="number" name="birth_from_year" value="<?=$birth_from_year?>"
                           class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                           min="1900" max="2099" placeholder="1900">

                    <p>-</p>

                    <input type="number" name="birth_to_year" value="<?=$birth_to_year?>"
                           class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                           min="1900" max="2099" placeholder="<?=date('Y')?>">
                </div>

            </div>

            <div class="flex flex-col justify-center gap-2">
                <p>Death year:</p>
                <div class="flex w-fit gap-1 border-2 border-main-accent rounded-3xl px-3 py-1">

                    <input type="number" name="death_from_year" value="<?=$death_from_year?>"
                           class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                           min="1900" max="2099" placeholder="1900">

                    <p>-</p>

                    <input type="number" name="death_to_year" value="<?=$death_to_year?>"
                           class="w-12 bg-transparent text-center focus:outline-0
                           placeholder:text-gray-600"
                           min="1900" max="2099" placeholder="<?=date('Y')?>">
                </div>

            </div>
        </div>

        <div class="flex gap-5">
            <input type="submit" value="Filter" class="btn-style">
            <?=Html::a('Reset', ['/artist'], ['class' => 'btn-style'])?>
        </div>

        <?=Html::endForm()?>
    </div>