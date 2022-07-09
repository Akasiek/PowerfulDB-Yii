<?php

use yii\helpers\Html;

?>

<div class="mb-10">
    <div class="flex items-center justify-between flex-wrap gap-2">
        <div class="flex items-center gap-4">
            <h1 class="font-sans text-4xl md:text-5xl"><?= ucfirst(Yii::$app->controller->id) ?> list</h1>
            <?php if (!Yii::$app->user->isGuest) {
                echo Html::a(
                    'add',
                    ['/' . Yii::$app->controller->id . '/create'],
                    ['class' => 'material-symbols-rounded text-secondary-dark p-0.5 rounded-full bg-main-accent']
                );
            } ?>
        </div>
    </div>
    <hr class="border-t-2 border-main-accent mt-3">
</div>