<?php

use common\models\Album;
use common\models\Artist;

$currentDate = date('m-d');
$birthdays = Artist::find()->andWhere("TO_CHAR(birth_date, 'MM-DD') = :currentDate", [':currentDate' => $currentDate])->all();
$death_anniversaries = Artist::find()->andWhere("TO_CHAR(death_date, 'MM-DD') = :currentDate", [':currentDate' => $currentDate])->all();
$album_anniversaries = Album::find()
    ->andWhere("TO_CHAR(release_date, 'MM-DD') = :currentDate", [':currentDate' => $currentDate])
    ->andWhere("TO_CHAR(release_date, 'YYYY') <= :currentYear", [':currentYear' => date('Y')])
    ->all();

function ordinal($number)
{
    $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
    if ((($number % 100) >= 11) && (($number % 100) <= 13))
        return $number . 'th';
    else
        return $number . $ends[$number % 10];
}

?>

<div>

    <h2 class="font-sans text-2xl md:text-3xl">On this day...</h2>

    <hr class="section-hr">

    <?php if (empty($birthdays) && empty($death_anniversaries) && empty($album_anniversaries)) : ?>

        <p class="text-lg">No anniversaries today</p>

    <?php else : ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-10">

            <?php foreach ($birthdays as $artist) {
                echo $this->render('_on_this_day_card', [
                    'model' => $artist,
                    'type' => 'birthday'
                ]);
            } ?>

            <?php foreach ($death_anniversaries as $artist) {
                echo $this->render('_on_this_day_card', [
                    'model' => $artist,
                    'type' => 'death_anniversary'
                ]);
            } ?>

            <?php foreach ($album_anniversaries as $album) {
                echo $this->render('_on_this_day_card', [
                    'model' => $album,
                    'type' => 'album_anniversary'
                ]);
            } ?>

        </div>

    <?php endif; ?>
</div>