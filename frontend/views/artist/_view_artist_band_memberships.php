<?php

/**
 * @var $model Artist
 */

use common\models\Artist;
use yii\helpers\Html;
use yii\helpers\Url;

$memberships = $model->getMemberships()->all();

?>
<?php if (count($memberships) !== 0) : ?>
    <div>
        <h1 class="section-title">Artist's Bands</h1>

        <hr class="section-hr">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 gap-4 md:gap-8">

            <?php foreach ($memberships as $index => $membership) : ?>
                <a href="<?= Url::to(['band/view', 'slug' => $membership->band->slug]) ?>" class="relative overflow-hidden flex items-center justify-center rounded-2xl h-40 md:h-48
                <?= (count($memberships) % 2 !== 0 && $index + 1 === count($memberships) ?
                    'col-span-1 sm:col-span-2 md:col-span-1 lg:col-span-2' : '') ?>">

                    <img src="<?= $membership->band->bg_image_url ?>" alt="<?= $membership->name ?> background image" class="absolute w-full h-full object-center object-cover opacity-25">

                    <div class="z-10 flex flex-col items-center justify-center w-full h-full group gap-0 md:gap-1">

                        <h1 class="font-sans text-3xl md:text-4xl relative after:cool-underline after:bg-main-light group-hover:after:cool-underline-hover drop-shadow-md">
                            <?= $membership->band->name ?>
                        </h1>

                        <p class="text-center max-w-xs text-xs md:text-sm drop-shadow-md two-line-truncate px-4" title="<?= $membership->roles ?>">
                            <?= $membership->roles ?>
                        </p>

                        <p class="text-gray-200 text-sm md:text-base italic drop-shadow-md">
                            <?= $membership->join_year ?> - <?= $membership->quit_year ?? 'present' ?>
                        </p>
                        <?php

                        ?>

                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>