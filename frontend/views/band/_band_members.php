<?php
/**
 * @var $model Band
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;

$bandMembers = $model->getMembers()->asArray()->all();


?>

<div>
    <div class="flex items-center gap-4">
        <h1 class="font-sans text-5xl">Members</h1>
        <?= Html::a('add', ['/band/member-add', 'slug' => $model->slug],
            ['class' => 'material-symbols-rounded text-secondary-dark p-0.5 rounded-full bg-main-accent']) ?>
    </div>

    <hr class="max-w-sm border-t-2 border-t-main-accent mt-2 mb-8">

    <?php if (count($bandMembers) !== 0): ?>
        <?php $i = 0 ?>
        <?php foreach ($bandMembers as $member): ?>

            <?php if ($member['artist_id'] !== null) {
                $artist = Artist::findOne($member['artist_id']);
            } ?>

            <div class="flex justify-center items-center w-full my-10">

                <?php if (isset($artist) && $artist->bg_image_url !== null): ?>
                    <div class="h-36 ml-10 aspect-square rounded-full">
                        <img src="<?= $artist->bg_image_url ?>" alt="Album artwork"
                             class="h-full w-full object-cover object-center rounded-full">
                    </div>
                <?php endif ?>

                <div class="col-span-2 ml-10 w-full flex-1">
                    <?php if ($member['name'] !== ''): ?>
                        <h2 class="text-2xl"><?= $member['name'] ?></h2>
                    <?php elseif (isset($artist)): ?>
                        <h2 class="text-2xl"><?= $artist->name ?></h2>
                    <?php endif ?>

                    <?php if ($member['join_year'] !== ''): ?>
                        <p class="italic text-gray-400">
                            <?= $member['join_year'] ?>
                            <?php
                            if ($member['quit_year'] !== null) echo ' - ' . $member['quit_year'];
                            else echo ' - present';
                            ?>
                        </p>
                    <?php endif ?>

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

            <?php if (++$i !== count($bandMembers)): ?>
                <hr class="my-8 border-t-2 border-t-gray-700 w-[60%] mx-auto">
            <?php endif ?>

        <?php endforeach; ?>
    <?php else: ?>

        <div class="article-style text-justify">
            <p>This band has no members added. You can go ahead and
                <?= Html::a('add member for this band',
                    ['/band/member-add', 'slug' => $model->slug],
                    ['class' => 'underline hover:text-main-accent transition-colors']) ?>
            </p>
        </div>

    <?php endif ?>
</div>
