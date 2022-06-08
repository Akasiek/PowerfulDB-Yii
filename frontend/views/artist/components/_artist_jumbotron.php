<?php
/**
 * @var $model Artist
 */

use common\models\Artist;

?>

<div class="!bg-cover !bg-center flex flex-col justify-end items-start w-full h-[650px] lg:h-[750px]"
     style="background:
             linear-gradient(180deg, rgba(94, 43, 255, 0) 40.63%,
             rgba(94, 43, 255, 0.5) 100%,
             rgba(94, 43, 255, 0.5) 100%),
             url('<?php echo $model->bg_image_url ?>'); ">
    <div class="px-14 pb-10 w-full">
        <h3 class="font-sans text-7xl mb-3"><?php echo $model->name ?></h3>
        <p class="text-2xl">
            <?php
            // TODO: Genres
            echo "Blues Rock • Experimental Rock"
            ?>
        </p>
    </div>
</div>
