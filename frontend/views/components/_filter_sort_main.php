<?php

/**
 * @var $hasGenreFilter bool
 * @var $genre string
 * @var $yearFilters array
 * @var $stringFilters array
 * @var $sort Sort
 * @var $sortOptions array
 */

use common\models\Album;
use common\models\Genre;
use yii\data\Sort;
use yii\helpers\Html;

$genreOptions = Genre::find()->orderBy('name')->all();

$typesSelected = Yii::$app->request->get('type') ?? [];
$genresSelected = Yii::$app->request->get('genre') ?? [];
?>

<?= Html::beginForm(['/' . Yii::$app->controller->id . '/'], 'get'); ?>
<div class="flex flex-col md:flex-row md:flex-wrap items-center justify-between gap-5 mb-10 mt-[-1rem]">

    <div class="flex flex-col md:flex-row flex-wrap items-center gap-x-8 gap-y-4 flex-1">
        <?php if (isset($sort)) : ?>
            <div>
                <?php
                $sortValue = key($sort->getAttributeOrders());
                if (array_values($sort->getAttributeOrders())[0] == 3) {
                    $sortValue = '-' . $sortValue;
                }

                echo Html::dropDownList('sort', $sortValue, $sortOptions, [
                    'class' => 'input-style m-0 !py-2',
                    'id' => 'select-slim-sort',
                    'onchange' => 'this.form.submit()',
                ]) ?>
            </div>
        <?php endif; ?>

        <div class="flex flex-col items-center gap-3">
            <p class="md:hidden flex items-center gap-2 btn-style !py-0" id="filters-text">
                Filters menu
                <span class="material-symbols-outlined !text-xl transition-transform" id="expand-icon">
                    expand_more
                </span>
            </p>
            <div class="hidden md:flex flex-col md:flex-row gap-4 flex-wrap justify-start md:items-center"
                 id="filters-form">
                <?php if (isset($hasTypeFilter) && $hasTypeFilter) : ?>
                    <div class="filter-container gap-y-0">
                        <label for="select-slim-album-type">Album type</label>

                        <select name="type[]" id="select-slim-album-type"
                                class="input-style !w-44 md:!w-40 lg:!w-48 xl:!w-56 !py-0" multiple>
                            <?php foreach (Album::TYPES as $type) : ?>
                                <option value="<?= $type ?>" <?= in_array($type, $typesSelected) ? "selected" : "" ?>><?= $type ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <?php if (isset($hasGenreFilter) && $hasGenreFilter) : ?>
                    <div class="filter-container gap-y-0">

                        <label for="select-slim-genre">Genre</label>

                        <select name="genre[]" id="select-slim-genre"
                                class="input-style !w-44 md:!w-40 lg:!w-48 xl:!w-56 !py-0" multiple>
                            <?php /** @var $genre Genre */
                            foreach ($genreOptions as $genre) : ?>
                                <option value="<?= $genre->id ?>" <?= in_array($genre->id, $genresSelected) ? "selected" : "" ?>><?= $genre->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <?php if (isset($yearFilters)) foreach ($yearFilters as $name => $filter) : ?>
                    <div class="filter-container">
                        <p><?= $filter['label'] ?></p>
                        <div class="filter-input-container">

                            <input type="number" name="<?= $name ?>_from_year" value="<?= $filter['from_year'] ?>"
                                   class="w-12 text-center filter-input-style" min="1900" max="2099"
                                   placeholder="1900">

                            <p>-</p>

                            <input type="number" name="<?= $name ?>_to_year" value="<?= $filter['to_year'] ?>"
                                   class="w-12 text-center filter-input-style" min="1900" max="2099"
                                   placeholder="<?= date('Y') ?>">
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (isset($stringFilters)) foreach ($stringFilters as $name => $filter) : ?>
                    <div class="filter-container">
                        <p><?= $filter['label'] ?></p>
                        <div class="filter-input-container">

                            <input type="text" name="<?= $name ?>" value="<?= $filter['value'] ?>"
                                   class="w-36 filter-input-style" placeholder="<?= $filter['placeholder'] ?>">
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>


    </div>

    <div class="flex gap-5 md:ml-auto">
        <input type="submit" value="Filter" class="btn-style">
        <?= Html::a('Reset', ['/' . Yii::$app->controller->id], ['class' => 'btn-style']) ?>
    </div>
</div>
<?= Html::endForm() ?>

