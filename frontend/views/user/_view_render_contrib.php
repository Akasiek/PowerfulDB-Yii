<?php

/**
 * @var $contrib Album | Artist | Band | AlbumGenre | BandMember | Track | AlbumArticle | ArtistArticle | BandArticle | EditSubmission
 * @var $model User
 */

use common\models\Album;
use common\models\AlbumArticle;
use common\models\AlbumGenre;
use common\models\EditSubmission;
use common\models\Track;
use common\models\Artist;
use common\models\ArtistArticle;
use common\models\Band;
use common\models\BandArticle;
use common\models\BandMember;
use common\models\User;

?>

<div class="bg-main-dark rounded-2xl w-full px-4 py-3 md:py-4 lg:py-3 xl:py-4 2xl:py-5 md:px-5">
    <div class="flex gap-3 xl:gap-4 items-center text-sm xl:text-base">

        <?php $class = explode('\\', $contrib::class)[2];
        match ($class) {
            'Album' => $file = '_album',
            'Artist' => $file = '_artist',
            'Band' => $file = '_band',
            'AlbumGenre' => $file = '_album_genre',
            'BandMember' => $file = '_band_member',
            'Track' => $file = '_track',
            'AlbumArticle', 'ArtistArticle', 'BandArticle' => $file = '_article',
            'EditSubmission' => $file = '_edit',
        };

        echo $this->render('contributions/' . $file, [
            'contrib' => $contrib,
            'model' => $model,
        ]); ?>

    </div>
</div>