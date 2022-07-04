<?php

use yii\helpers\Html;

$name = Yii::$app->request->get('name');
?>

<div>
    <?= Html::beginForm(['/genre/'], 'get'); ?>
    <div class="flex items-center  flex-wrap justify-between gap-5 mb-10 mt-[-1rem]">

        <div class="flex flex-col justify-center gap-2">

            <div class="flex flex-col justify-center gap-2">
                <p>Filter genre:</p>
                <div class="flex gap-1 border-2 border-main-accent rounded-3xl px-3 py-1">

                    <input type="text" name="name" value="<?= $name ?>" class="w-36 bg-transparent focus:outline-0
                   placeholder:text-gray-600" placeholder="Rock">

                </div>

            </div>
        </div>

        <div class="flex gap-5">
            <input type="submit" value="Filter" class="btn-style">
            <?= Html::a('Reset', ['/genre/'], ['class' => 'btn-style']) ?>
        </div>
        <?= Html::endForm() ?>
    </div>