<?php

/**
 * @var $contrib Album | Artist | Band | AlbumGenre | BandMember | Track
 * @var $model User
 */

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use common\models\AlbumGenre;
use common\models\BandMember;
use common\models\Track;
use common\models\User;
use yii\helpers\Html;

?>

<div class="bg-main-dark rounded-2xl w-full px-4 py-3 md:py-4 lg:py-3 xl:py-4 2xl:py-5 md:px-5">
    <div class="flex gap-3 xl:gap-4 items-center text-sm xl:text-base">
        <?php if ($contrib instanceof Album) : ?>
            <span class="material-symbols-rounded !text-lg xl:!text-xl">
                album
            </span>
            <p>
                <?= $model->username . ' created' ?>
                <?= $contrib->type !== "LP" ? strtolower($contrib->type) : " album " . "called" ?>
                <?= Html::a(
                    $contrib->title,
                    ['album/view', 'slug' => $contrib->slug],
                    ['class' => 'font-bold text-main-accent hover:underline']
                ) . ' by ' ?>
                <?php if ($contrib->artist_id) {
                    echo Html::a(
                        $contrib->artist->name,
                        ['artist/view', 'slug' => $contrib->artist->slug],
                        ['class' => 'italic text-main-accent hover:underline']
                    );
                } else {
                    echo Html::a(
                        $contrib->band->name,
                        ['band/view', 'slug' => $contrib->band->slug],
                        ['class' => 'italic text-main-accent hover:underline']
                    );
                }; ?>
            </p>
        <?php elseif ($contrib instanceof Artist) : ?>
            <span class="material-symbols-rounded !text-lg xl:!text-xl">
                mic_external_on
            </span>
            <p>
                <?= $model->username . ' created artist called ' ?>
                <?= Html::a(
                    $contrib->name,
                    ['artist/view', 'slug' => $contrib->slug],
                    ['class' => 'font-bold text-main-accent hover:underline']
                ) ?>
            </p>
        <?php elseif ($contrib instanceof Band) : ?>
            <span class="material-symbols-rounded !text-lg xl:!text-xl">
                groups
            </span>
            <p>
                <?= $model->username . ' created band called ' ?>
                <?= Html::a(
                    $contrib->name,
                    ['band/view', 'slug' => $contrib->slug],
                    ['class' => 'font-bold text-main-accent hover:underline']
                ) ?>
            </p>
        <?php elseif ($contrib instanceof AlbumGenre) : ?>
            <span class="material-symbols-rounded !text-lg xl:!text-xl">
                collections_bookmark
            </span>
            <p>
                <?= $model->username . ' added '; ?>
                <span class="font-bold">
                    <?= $contrib->genre_count . ($contrib->genre_count === 1 ? ' genre ' : ' genres ') ?>
                </span>
                <?= ' to the album called ' ?>
                <?= Html::a(
                    $contrib->album->title,
                    ['album/view', 'slug' => $contrib->album->slug],
                    ['class' => 'italic text-main-accent hover:underline']
                ) ?>
            </p>
        <?php elseif ($contrib instanceof Track) : ?>
            <span class="material-symbols-rounded !text-lg xl:!text-xl">
                library_music
            </span>
            <p>
                <?= $model->username . ' added '; ?>
                <span class="font-bold">
                    <?= $contrib->track_count . ($contrib->track_count === 1 ? ' track ' : ' tracks ') ?>
                </span>
                <?= ' to the album called ' ?>
                <?= Html::a(
                    $contrib->album->title,
                    ['album/view', 'slug' => $contrib->album->slug],
                    ['class' => 'italic text-main-accent hover:underline']
                ) ?>
            </p>
        <?php elseif ($contrib instanceof BandMember) : ?>
            <span class="material-symbols-rounded !text-lg xl:!text-xl">
                person_add
            </span>
            <p>
                <?= $model->username . ' added '; ?>
                <span class="font-bold">
                    <?= $contrib->member_count . ($contrib->member_count === 1 ? ' member ' : ' members ') ?>
                </span>
                <?= ' to the band called ' ?>
                <?= Html::a(
                    $contrib->band->name,
                    ['band/view', 'slug' => $contrib->band->slug],
                    ['class' => 'italic text-main-accent hover:underline']
                ) ?>
            </p>
        <?php endif; ?>
    </div>
</div>