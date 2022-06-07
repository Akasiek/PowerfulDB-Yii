<?php
/**
 * @var $model Artist
 */

use common\models\Artist;
use yii\helpers\Html;

?>

<a href="<?php echo \yii\helpers\Url::to(['/artist/view', 'slug' => $model->slug]) ?>">
    <div class="rounded-3xl w-80 h-44 !bg-cover flex flex-col justify-end items-start snap-start scroll-pl-3"
         style="background: linear-gradient(180deg, rgba(94, 43, 255, 0) 38.54%,
                 rgba(94, 43, 255, 0.5) 100%),
                 linear-gradient(0deg, rgba(94, 43, 255, 0.15),
                 rgba(94, 43, 255, 0.15)),
                 url('<?php echo $model->bg_image_url ?>'),
                 #292A33">

        <div class="px-7 pb-5 w-full">
            <h3 class="font-sans text-2xl truncate"><?php echo $model->name ?></h3>
            <p class="text-xs truncate">
                <?php
                // TODO: Genres
                echo "Blues Rock • Experimental Rock"
                ?>
            </p>
        </div>
    </div>
</a>
