<?php
/**
 * @var $model Band
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;

$bandMembers = $model->getMembers()->asArray()->all();
//Get current members of band
$bandCurrentMembers = [];
$bandPastMembers = [];
foreach ($bandMembers as $member) {
    if ($member['quit_year'] === null) $bandCurrentMembers[] = $member;
    else $bandPastMembers[] = $member;
}

$membersArrays = [
    'current' => $bandCurrentMembers,
    'past' => $bandPastMembers,
];
?>
<?php if (empty($membersArrays)): ?>
    <div>
        <h1 class="font-sans text-5xl">Members</h1>
        <hr class="max-w-sm border-t-2 border-t-main-accent mt-2 mb-8">
        <div class="article-style text-justify">
            <p>This band has no members added. You can go ahead and
                <?= Html::a('add member for this band',
                    ['/band/member-add', 'slug' => $model->slug],
                    ['class' => 'underline hover:text-main-accent transition-colors']) ?>
            </p>
        </div>
    </div>
<?php else: ?>
    <div>
        <div class="flex items-center gap-4">
            <h1 class="font-sans text-5xl">Members</h1>
            <?= Html::a('add', ['/band/member-add', 'slug' => $model->slug],
                ['class' => 'material-symbols-rounded text-secondary-dark p-0.5 rounded-full bg-main-accent']) ?>
        </div>

        <hr class="max-w-sm border-t-2 border-t-main-accent mt-2 mb-8">

        <?php foreach ($membersArrays as $arrayName => $members): ?>
            <?php if (!empty($members)): ?>
                <div class="mt-8 mb-12">
                    <h3 class="text-xl capitalize"><?= $arrayName ?> members</h3>
                    <hr class="w-52 border-t-2 border-t-gray-400 mt-1 mb-8">

                    <?php $i = 0 ?>
                    <?php foreach ($members as $member): ?>

                        <?php if ($member['artist_id'] !== null) {
                            $artist = Artist::findOne($member['artist_id']);
                        } else {
                            $artist = null;
                        } ?>

                        <div class="flex justify-center items-center w-full my-9">

                            <?php if (isset($artist) && $artist->bg_image_url !== null): ?>
                                <div class="h-32 ml-10 aspect-square rounded-full">
                                    <?= Html::a(Html::img($artist->bg_image_url,
                                        [
                                            'class' => 'h-full w-full object-cover object-center rounded-full shadow-xl
                                            border-2 border-main-dark hover:shadow-accent hover:border-main-accent
                                            transition-all duration-100 ease-in-out',
                                            'alt' => 'Artist background image'
                                        ]),
                                        ['/artist/view', 'slug' => $artist->slug]) ?>
                                </div>
                            <?php endif ?>

                            <div class="col-span-2 ml-10 w-full flex-1">
                                <div class="flex items-center gap-2">
                                    <?php if ($member['name'] !== ''): ?>
                                        <h2 class="text-2xl"><?= $member['name'] ?></h2>
                                    <?php elseif (isset($artist)): ?>
                                        <?= Html::a($artist->name, ['/artist/view', 'slug' => $artist->slug], [
                                            'class' => 'text-2xl underline hover:text-main-accent transition-colors'
                                        ]) ?>
                                    <?php endif ?>

                                    <?php if ($member['join_year'] !== ''): ?>
                                        <p class="mb-1 text-gray-600">|</p>
                                        <p class="italic text-gray-400">
                                            <?= $member['join_year'] ?>
                                            <?php
                                            if ($member['quit_year'] !== null) echo ' - ' . $member['quit_year'];
                                            else echo ' - present';
                                            ?>
                                        </p>
                                    <?php endif ?>
                                </div>

                                <?php if ($member['roles'] !== ''): ?>
                                    <div class="w-80">
                                        <p id="roles" class="text-sm mt-1 text-gray-400 two-line-truncate "
                                           title="<?= $member['roles'] ?>">
                                            <?= $member['roles'] ?>
                                        </p>
                                    </div>
                                <?php endif ?>
                            </div>

                        </div>

                        <?php if (++$i !== count($members)): ?>
                            <hr class="my-8 border-t-2 border-t-gray-700 w-[60%] mx-auto">
                        <?php endif ?>
                    <?php endforeach; ?>

                </div>
            <?php endif ?>
        <?php endforeach; ?>

    </div>
<?php endif; ?>
