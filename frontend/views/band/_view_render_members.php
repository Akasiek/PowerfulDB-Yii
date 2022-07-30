<?php
/**
 * @var $band Band
 * @var $members array
 * @var $arrayName string
 */

use common\models\Band;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if (!empty($members)) : ?>
    <div class="mt-8 mb-12">
        <h3 class="text-xl capitalize"><?= $arrayName ?> members</h3>
        <hr class="w-52 border-t-2 border-t-gray-400 mt-1 mb-8">

        <?php foreach ($members as $index => $member) : ?>

            <div class="flex items-center w-full my-9">

                <?php if (isset($member->artist) && $member->artist->bg_image_url !== null) : ?>
                    <div class="h-24 md:h-28 lg:h-32 ml-0 md:ml-6 lg:ml-10 aspect-square rounded-full">
                        <a href="<?= Url::to(['/artist/view', 'slug' => $member->artist->slug]) ?>">
                            <?= Html::img(
                                $member->artist->bg_image_url,
                                [
                                    'class' => 'h-full w-full object-cover object-center rounded-full shadow-xl
                                            border-2 border-main-dark hover:shadow-accent hover:border-main-accent
                                            transition-all duration-100 ease-in-out',
                                    'alt' => $member->artist->name . ' background image'
                                ]
                            ) ?>
                        </a>
                    </div>
                <?php endif ?>

                <div class="ml-4 md:ml-8 lg:ml-10">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-0 md:gap-2">
                        <?php if ($member->name !== null) : ?>
                            <h2 class="text-lg md:text-xl lg:text-2xl"><?= $member->name ?></h2>
                        <?php elseif (isset($member->artist)) : ?>
                            <?= Html::a(
                                $member->artist->name,
                                ['/artist/view', 'slug' => $member->artist->slug],
                                ['class' => 'text-lg md:text-xl lg:text-2xl hover:text-main-accent transition-colors']
                            ) ?>
                        <?php endif ?>

                        <?php if ($member->join_year !== '') : ?>
                            <p class="mb-1 text-gray-600 hidden md:block">|</p>
                            <p class="italic text-gray-400 text-xs md:text-sm lg:text-base">
                                <?= $member->join_year ?>
                                <?= $member->quit_year !== null ? ' - ' . $member->quit_year : ' - present' ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <?php if ($member->roles !== '') : ?>
                        <div class="max-w-md">
                            <p id="roles" class="text-sm md:text-base mt-1 text-gray-400 two-line-truncate "
                               title="<?= $member->roles ?>">
                                <?= $member->roles ?>
                            </p>
                        </div>
                    <?php endif ?>
                </div>

                <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="ml-4 md:ml-6 lg:ml-8">
                        <?= Html::a('edit', [
                            'member-edit',
                            'memberId' => $member->id,
                            'bandSlug' => $band->slug
                        ], ['class' => 'material-symbols-outlined text-gray-600 hover:text-main-accent transition-colors !text-xl md:!text-lg lg:!text-2xl',]) ?>
                    </div>
                <?php endif ?>
            </div>

            <?php if ($index + 1 !== count($members)) : ?>
                <hr class="my-8 border-t-2 border-t-gray-700 w-[60%] mx-auto">
            <?php endif ?>
        <?php endforeach; ?>

    </div>
<?php endif ?>
