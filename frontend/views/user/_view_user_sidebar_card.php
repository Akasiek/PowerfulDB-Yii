<?php

/** 
 * @model User
 */

use common\models\User;


$counts = $model->getContributionsCount();


?>
<div class="rounded-3xl bg-main-dark overflow-hidden min-w-[18rem] h-fit">
    <div class="bg-main-accent flex flex-col items-center">
        <div class="flex flex-wrap w-full gap-4 items-center py-4 px-6 max-w-[24rem]">
            <img src="<?= $model->profile_pic_url ?? 'https://icon-library.com/images/default-profile-icon/default-profile-icon-16.jpg' ?>" alt="Profile picture of a user" class="h-20 rounded-full object-center object-cover aspect-square">
            <h2 class="text-lg font-bold text-secondary-dark" title="<?= $model->username ?>">
                <?= $model->username ?>
            </h2>
        </div>

        <?php if ($model->about_text) : ?>
            <div class="pt-2 pb-4 px-6 text-secondary-dark max-w-[20rem]">
                <?= $model->about_text ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="mx-6 pt-6 pb-6">
        <div class="grid grid-cols-3 gap-y-4 text-center">
            <div>
                <p class="text-lg font-bold flex justify-center gap-1 items-center">
                    <span class="material-symbols-rounded !text-lg">
                        album
                    </span>
                    <?= $counts['albums'] ?>
                </p>
                <p>Albums</p>
            </div>
            <div>
                <p class="text-lg font-bold flex justify-center gap-1 items-center">
                    <span class="material-symbols-rounded !text-lg">
                        mic_external_on
                    </span>
                    <?= $counts['artists'] ?>
                </p>
                <p>Artists</p>
            </div>
            <div>
                <p class="text-lg font-bold flex justify-center gap-1 items-center">
                    <span class="material-symbols-rounded !text-lg">
                        groups
                    </span>
                    <?= $counts['bands'] ?>
                </p>
                <p>Bands</p>
            </div>
            <div>
                <p class="text-lg font-bold flex justify-center gap-1 items-center">
                    <span class="material-symbols-rounded !text-lg">
                        library_music
                    </span>
                    <?= $counts['tracks'] ?>
                </p>
                <p>Tracks</p>
            </div>
            <div>
                <p class="text-lg font-bold flex justify-center gap-1 items-center">
                    <span class="material-symbols-rounded !text-lg">
                        collections_bookmark
                    </span>
                    <?= $counts['genres'] ?>
                </p>
                <p>Genres</p>
            </div>
            <div>
                <p class="text-lg font-bold flex justify-center gap-1 items-center">
                    <span class="material-symbols-rounded !text-lg">
                        person_add
                    </span>
                    <?= $counts['bandMembers'] ?>
                </p>
                <p>Members</p>
            </div>
        </div>

        <hr class="my-6 border-t-2 border-t-gray-600">

        <div class="flex flex-col gap-2">
            <p>
                Articles wrote: <span class="font-bold"><?= $counts['articles'] ?></span>
            </p>
            <p>
                <!-- TODO -->
                Edits submitted: <span class="font-bold">109</span>
            </p>
        </div>
    </div>
</div>