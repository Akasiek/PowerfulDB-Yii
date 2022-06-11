<?php
/**
 * @var $model Artist
 */

use common\models\Artist;
use yii\helpers\Html;

?>
<a href="<?php echo \yii\helpers\Url::to(['/artist/view', 'slug' => $model->slug]) ?>">
    <div class="rounded-3xl w-full h-48 !bg-cover flex flex-col justify-end items-start snap-start scroll-pl-3"
         style="background: linear-gradient(180deg, rgba(94, 43, 255, 0) 25%,
                 rgba(94, 43, 255, 0.75) 100%),
                 linear-gradient(0deg, rgba(94, 43, 255, 0.1),
                 rgba(94, 43, 255, 0.1)),
                 url('<?php echo $model->bg_image_url ?>'),
                 #292A33">

        <div class="px-7 pb-4 w-full">

            <h3 class="font-sans text-3xl truncate"><?php echo $model->name ?></h3>
            <p class="text-sm truncate">
                <?php
                // TODO: Genres
                echo "Blues Rock • Experimental Rock"
                ?>

            </p>
        </div>
    </div>
</a>
