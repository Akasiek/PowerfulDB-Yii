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
?>

<div class="py-14 px-20 w-full  flex justify-center items-center">
    <?php $form = ActiveForm::begin() ?>

    <h1 class="text-5xl font-sans mb-6">Add a member to <?= $band->name ?></h1>


    <div class="flex flex-col gap-10 w-[30rem] xl:w-[40rem]">

        <p>
            Search for a desired artist below. If you don't find the artist you're looking for, you can add it as a
            <a href="<?= Url::to('/artist/create') ?>" class="text-main-accent underline">new artist</a> or just add a
            name
        </p>

        <!-- ARTIST INPUT -->
        <div>
            <label for="author_id" class="text-2xl">Choose artist</label>
            <select id="select-slim" name="BandMember[artist_id]" class="input-style">
                <option data-placeholder="true">Select an artist</option>
                <?php foreach ($artists as $artist): ?>
                    <option value="<?= $artist['id'] ?>"><?= $artist['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- NAME INPUT -->
        <?= $form->field($model, 'name', [
            'labelOptions' => ['class' => 'text-2xl'],
            'errorOptions' => ['class' => 'text-red-500'],
        ])
            ->textInput(['maxlength' => 255, 'class' => 'input-style', 'placeholder' => 'Jack White'])
            ->label('Name (if artist wasn\'t found above)')
        ?>

        <div class="grid grid-cols-2 gap-10">

            <!-- JOIN YEAR INPUT -->
            <?= $form->field($model, 'join_year', [
                'labelOptions' => ['class' => 'text-2xl'],
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('number', ['class' => 'input-style', 'placeholder' => '1975']) ?>

            <!-- QUIT YEAR INPUT -->
            <?= $form->field($model, 'quit_year', [
                'labelOptions' => ['class' => 'text-2xl'],
                'errorOptions' => ['class' => 'text-red-500'],
            ])->input('number', ['class' => 'input-style', 'placeholder' => '2010'])
                ->label('Quit year (if quit)') ?>

        </div>

        <!-- ROLE INPUT -->
        <?= $form->field($model, 'roles', [
            'labelOptions' => ['class' => 'text-2xl'],
            'errorOptions' => ['class' => 'text-red-500'],
        ])
            ->textInput(['maxlength' => 255, 'class' => 'input-style', 'placeholder' => 'vocals, guitar, bass...'])
        ?>

        <!-- SUBMIT BUTTON -->
        <div class="text-right">
            <input type="submit" value="Submit"
                   class="btn-style">
        </div>

    </div>

    <?php ActiveForm::end() ?>
</div>