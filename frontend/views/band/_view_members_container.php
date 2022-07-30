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
<div id="members">
    <div class="flex items-center gap-2 md:gap-4">
        <h1 class="section-title">Members</h1>
        <?php if (!Yii::$app->user->isGuest) {
            echo Html::a(
                'add',
                ['/band/member-add', 'slug' => $model->slug],
                ['class' => 'material-symbols-rounded text-secondary-dark scale-90 md:scale-100 md:p-0.5 rounded-full bg-main-accent']
            );
        } ?>
    </div>

    <hr class="section-hr">

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
            <?= $this->render('_view_render_members', [
                'band' => $model,
                'members' => $members,
                'arrayName' => $arrayName,
            ]) ?>
        <?php endforeach; ?>

    <?php endif; ?>
</div>