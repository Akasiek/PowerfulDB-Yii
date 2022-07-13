<?php

/** 
 * @model User
 */

use common\models\User;


$counts = $model->getContributionsCount();

?>
<div class="rounded-3xl bg-main-dark overflow-hidden h-fit xl:max-w-sm mx-auto
            flex flex-col sm:flex-row xl:flex-col">
    <div class="bg-main-accent py-4 px-4 sm:px-6 flex flex-col gap-2 md:gap-4 sm:w-fit xl:w-full justify-center">
        <div class="flex flex-wrap w-full gap-2 md:gap-4 items-center">
            <img src="<?= $model->profile_pic_url ?? 'https://icon-library.com/images/default-profile-icon/default-profile-icon-16.jpg' ?>" alt="Profile picture of a user" class="h-12 sm:h-16 xl:h-20 rounded-full object-center object-cover aspect-square">
            <h2 class="text-base md:text-lg lg:text-base xl:text-lg font-bold text-secondary-dark" title="<?= $model->username ?>">
                <?= $model->username ?>
            </h2>
        </div>

        <div class="text-secondary-dark sm:w-max">
            <p class="italic text-sm sm:text-base md:text-sm xl:text-base">
                Points: <span class="font-bold"><?= $counts['points'] ?></span> •
                Contribitions: <span class="font-bold"><?= $counts['total'] ?></span>
            </p>
        </div>

        <?php if ($model->about_text) : ?>
            <div class="text-secondary-dark max-w-xs
                        text-sm :text-base lg:text-sm xl:text-base">
                <?= $model->about_text ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="py-6 px-4 sm:p-6 grid gap-x-2 gap-y-4 m-auto text-center w-full sm:w-auto xl:w-full
                grid-cols-3 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
        <?php foreach ($counts as $name => $count) : ?>
            <?php if ($name !== 'total' && $name !== 'points') : ?>
                <div>
                    <p class="lg:text-lg font-bold flex justify-center gap-1 items-center">
                        <span class="material-symbols-rounded !text-base lg:!text-lg">
                            <?php
                            if ($name == "albums") echo "album";
                            elseif ($name == "artists") echo "mic_external_on";
                            elseif ($name == "bands") echo "groups";
                            elseif ($name == "tracks") echo "library_music";
                            elseif ($name == "genres") echo "collections_bookmark";
                            elseif ($name == "members") echo "person_add";
                            elseif ($name == "articles") echo "feed";
                            elseif ($name == "edits") echo "edit";
                            ?>
                        </span>
                        <?= $count ?>
                    </p>
                    <p class="text-sm xl:text-base"><?= ucwords($name) ?></p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>