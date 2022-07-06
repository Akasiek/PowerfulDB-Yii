<?php

/**
 * @var $model Band
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;

$bandMembers = $model->getMembers()->all();

//Get current members of band
$bandCurrentMembers = [];
$bandPastMembers = [];
foreach ($bandMembers as $member) {
    if ($member->quit_year === null) $bandCurrentMembers[] = $member;
    else $bandPastMembers[] = $member;
}

$membersArrays = [
    'current' => $bandCurrentMembers,
    'past' => $bandPastMembers,
];


?>
<div>
    <div class="flex items-center gap-4">
        <h1 class="font-sans text-5xl">Members</h1>
        <?php if (!Yii::$app->user->isGuest) {
            echo Html::a(
                'add',
                ['/band/member-add', 'slug' => $model->slug],
                ['class' => 'material-symbols-rounded text-secondary-dark p-0.5 rounded-full bg-main-accent']
            );
        } ?>
    </div>

    <hr class="max-w-sm border-t-2 border-t-main-accent mt-2 mb-8">

    <?php if (empty($bandMembers)) : ?>

        <div class="article-style text-justify">
            <p>This band has no members added.
                <?php if (!Yii::$app->user->isGuest) : ?>
                    You can go ahead and
                    <?= Html::a(
                        'add member for this band',
                        ['/band/member-add', 'slug' => $model->slug],
                        ['class' => 'hover:underline text-main-accent']
                    ) ?>
                <?php else : ?>
                    <?= Html::a(
                        'Log in to add them',
                        ['/login'],
                        ['class' => 'hover:underline text-main-accent']
                    ) ?>
                <?php endif; ?>
            </p>
        </div>

    <?php else : ?>

        <?php foreach ($membersArrays as $arrayName => $members) : ?>
            <?php if (!empty($members)) : ?>
                <div class="mt-8 mb-12">
                    <h3 class="text-xl capitalize"><?= $arrayName ?> members</h3>
                    <hr class="w-52 border-t-2 border-t-gray-400 mt-1 mb-8">

                    <?php foreach ($members as $index => $member) : ?>

                        <div class="flex justify-center items-center w-full my-9">

                            <?php if (isset($member->artist) && $member->artist->bg_image_url !== null) : ?>
                                <div class="h-32 ml-10 aspect-square rounded-full">
                                    <?= Html::a(
                                        Html::img(
                                            $member->artist->bg_image_url,
                                            [
                                                'class' => 'h-full w-full object-cover object-center rounded-full shadow-xl
                                            border-2 border-main-dark hover:shadow-accent hover:border-main-accent
                                            transition-all duration-100 ease-in-out',
                                                'alt' => $member->artist->name . ' background image'
                                            ]
                                        ),
                                        ['/artist/view', 'slug' => $member->artist->slug]
                                    ) ?>
                                </div>
                            <?php endif ?>

                            <div class="col-span-2 ml-10 w-full flex-1">
                                <div class="flex items-center gap-2">
                                    <?php if ($member->name !== null) : ?>
                                        <h2 class="text-2xl"><?= $member->name ?></h2>
                                    <?php elseif (isset($member->artist)) : ?>
                                        <?= Html::a(
                                            $member->artist->name,
                                            ['/artist/view', 'slug' => $member->artist->slug],
                                            [
                                                'class' => 'text-2xl underline hover:text-main-accent transition-colors'
                                            ]
                                        ) ?>
                                    <?php endif ?>

                                    <?php if ($member->join_year !== '') : ?>
                                        <p class="mb-1 text-gray-600">|</p>
                                        <p class="italic text-gray-400">
                                            <?= $member->join_year ?>
                                            <?php
                                            if ($member->quit_year !== null) echo ' - ' . $member->quit_year;
                                            else echo ' - present';
                                            ?>
                                        </p>
                                    <?php endif ?>
                                </div>

                                <?php if ($member->roles !== '') : ?>
                                    <div class="w-80">
                                        <p id="roles" class="text-sm mt-1 text-gray-400 two-line-truncate " title="<?= $member->roles ?>">
                                            <?= $member->roles ?>
                                        </p>
                                    </div>
                                <?php endif ?>
                            </div>

                        </div>

                        <?php if ($index + 1 !== count($members)) : ?>
                            <hr class="my-8 border-t-2 border-t-gray-700 w-[60%] mx-auto">
                        <?php endif ?>
                    <?php endforeach; ?>

                </div>
            <?php endif ?>
        <?php endforeach; ?>

    <?php endif; ?>
</div>