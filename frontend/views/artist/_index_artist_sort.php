<?php
/**
 * @var $sort Sort
 */

use yii\data\Sort;
use yii\helpers\Html;

?>

<div>
    <?= Html::beginForm(['/artist/'], 'get'); ?>

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
                    ]) ?>
                </div>
            </div>
        </div>

        <?= Html::endForm() ?>
    </div>