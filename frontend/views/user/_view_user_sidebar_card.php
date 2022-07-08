<?php

/** 
 * @model User
 */

use common\models\User;


$counts = $model->getContributionsCount();


?>
<div class="rounded-3xl bg-main-dark overflow-hidden min-w-[18rem] h-fit">
    <div class="bg-main-accent pb-4 flex flex-col items-center">
        <div class="flex flex-wrap w-full gap-4 items-center py-4 px-6 max-w-[24rem]">
            <img src="<?= $model->profile_pic_url ?>" alt="Profile picture of a user" class="h-20 rounded-full object-center object-cover aspect-square">
            <h2 class="text-lg font-bold text-secondary-dark" title="<?= $model->username ?>">
                <?= $model->username ?>
            </h2>
        </div>

        <div class="py-2 px-6 text-secondary-dark max-w-[20rem]">
            <?= $model->about_text ?>
        </div>
    </div>

    <div class="mx-6 pt-6 pb-6">
        <div class="grid grid-cols-3 text-center">
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
        </div>

        <hr class="my-6 border-t-2 border-t-gray-600">

        <div class="flex flex-col gap-2">
            <p>
                Genres added: <span class="font-bold"><?= $counts['genres'] ?></span>
            </p>
            <p>
                Tracks added: <span class="font-bold"><?= $counts['tracks'] ?></span>
            </p>
            <p>
                Band members added: <span class="font-bold"><?= $counts['bandMembers'] ?></span>
            </p>
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