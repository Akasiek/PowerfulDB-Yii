<?php
/**
 * @var $model Artist
 */

use common\models\Artist;
use yii\helpers\Html;
use yii\helpers\Url;

//$bands = $model->getBands()->all();
$memberships = $model->getMemberInfo()->orderBy('join_year ASC')->all();

?>
<?php if (count($memberships) !== 0): ?>
    <div>
        <h1 class="font-sans text-5xl">Bands</h1>

        <hr class="max-w-sm  border-t-2 border-t-main-accent mt-2 mb-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <?php foreach ($memberships as $index => $membership): ?>
                <a href="<?= Url::to(['band/view', 'slug' => $membership->band->slug]) ?>"
                   class="relative overflow-hidden flex items-center justify-center rounded-2xl block
                <?php if (count($memberships) % 2 !== 0 && $index + 1 === count($memberships)) {
                       echo 'col-span-2 h-64';
                   } else echo 'h-48' ?>">

                    <img src="<?= $membership->band->bg_image_url ?>" alt="<?= $membership->name ?> background image"
                         class="absolute w-full h-full object-center object-cover opacity-25">

                    <div class="z-10 flex flex-col items-center  justify-center w-full h-full group  ">

                        <h1 class="font-sans text-4xl relative after:cool-underline after:bg-main-light group-hover:after:cool-underline-hover">
                            <?= $membership->band->name ?>
                        </h1>

                        <p class='text-center w-80 text-sm'><?= $membership->roles ?></p>

                        <p class="text-gray-200 italic">
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
