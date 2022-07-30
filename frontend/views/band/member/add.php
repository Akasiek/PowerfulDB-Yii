<?php

/**
 * @var $model BandMember
 * @var $band Band
 */

use common\models\Artist;
use common\models\Band;
use common\models\BandMember;
use kartik\form\ActiveForm;
use yii\helpers\Url;

$artists = Artist::find()->asArray()->all();

$this->title = 'Add Member';
?>

<div class="py-10 lg:py-14 px-6 md:px-10 lg:px-20 w-full flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="form-title mb-2 md:mb-4">Add a member to <?= $band->name ?></h1>


    <div class="flex flex-col gap-6 md:gap-10 max-w-lg xl:max-w-2xl text-sm sm:text-base md:text-lg">

        <p class="text-xs sm:text-sm md:text-base">
            Search for a desired artist below. If you don't find the artist you're looking for, you can add it as a
            <a href="<?= Url::to('/artist/create') ?>" class="text-main-accent underline">new artist</a> or just add a
            name
        </p>

        <!-- ARTIST INPUT -->
        <div>
            <label for="author_id">Choose artist</label>
            <select id="select-slim" name="BandMember[artist_id]" class="input-style disabled:placeholder:line-through disabled:border-gray-400">
                <option data-placeholder="true" value="0">Select an artist</option>
                <?php foreach ($artists as $artist) : ?>
                    <option value="<?= $artist['id'] ?>"><?= $artist['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- NAME INPUT -->
        <?= $form->field($model, 'name', [
            'labelOptions' => ['class' => 'peer-disabled:line-through'],
            'errorOptions' => ['class' => 'text-red-500'],
        ])
            ->textInput([
                'maxlength' => 255,
                'class' => 'peer input-style disabled:border-gray-400 disabled:placeholder:line-through',
                'id' => 'member-name', 'placeholder' => 'Jack White'
            ])
            ->label("Name (if artist wasn't found above)")
        ?>

        <div class="grid grid-cols-2 gap-4 sm:gap-8 md:gap-10">

            <!-- JOIN YEAR INPUT -->
            <?= $form->field($model, 'join_year', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('number', ['class' => 'input-style', 'placeholder' => '1975']) ?>

            <!-- QUIT YEAR INPUT -->
            <?= $form->field($model, 'quit_year', [
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('number', ['class' => 'input-style', 'placeholder' => '2010'])
                ->label('Quit year (if quit)') ?>

        </div>

        <!-- ROLE INPUT -->
        <?= $form->field($model, 'roles', [
            'errorOptions' => ['class' => 'text-red-500'],
        ])
            ->textInput(['maxlength' => 255, 'class' => 'input-style', 'placeholder' => 'vocals, guitar, bass...'])
        ?>

        <!-- SUBMIT BUTTON -->
        <div class="text-right">
            <input type="submit" value="Submit" class="btn-style">
        </div>

    </div>

    <?php ActiveForm::end() ?>
</div>