<?php
/**
 * @var $model Artist
 */

use common\models\Artist;

include Yii::getAlias('@frontend/web/ageDiff.php');

?>

<div class="!bg-cover !bg-center flex flex-col justify-end items-start w-full h-[650px] lg:h-[750px]"
     style="background:
             linear-gradient(180deg, rgba(94, 43, 255, 0) 30%,
             rgba(94, 43, 255, 0.85) 100%,
             rgba(94, 43, 255, 0.85) 100%),
             url('<?php echo $model->bg_image_url ?>'); ">
    <div class="px-14 pb-10 w-full">


        <div class="flex items-end gap-4">
            <h3 class="font-sans text-7xl"><?php echo $model->name ?></h3>
            <?php if ($model->full_name): ?>
                <p class="text-gray-300 italic mb-2"><?php echo $model->full_name ?></p>
            <?php endif; ?>
        </div>


        <p class="text-2xl">
            <?php
            // TODO: Genres
            echo "Blues Rock • Experimental Rock"
            ?>
        </p>

        <div class="mt-2">
            <?php if ($model->birth_date): ?>
            
                <p>
                    Age: <?php echo ageDiff($model->birth_date, $model->death_date) ?> years old
                </p>

                <p class="text-gray-300">
                    Born: <?php echo Yii::$app->formatter->asDate($model->birth_date, 'long') ?>
                </p>

                <?php if ($model->death_date): ?>
                    <p class="text-gray-300">
                        Died: <?php echo Yii::$app->formatter->asDate($model->death_date, 'long') ?>
                    </p>
                <?php endif; ?>

            <?php endif; ?>
        </div>

    </div>
</div>
