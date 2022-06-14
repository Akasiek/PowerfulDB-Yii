<?php

use yii\helpers\Url;

?>

<div class="mb-10">
    <div class="flex items-center justify-between">
        <h1 class="font-sans text-5xl "><?php echo ucfirst(Yii::$app->controller->id) ?> list</h1>
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="flex">
                <a href="<?php echo Url::to('/' . Yii::$app->controller->id . '/create') ?>">
                    <div class="flex items-center justify-center gap-2
                    py-2 pl-5 pr-3 bg-main-accent rounded-3xl text-secondary-dark font-bold">
                        Add <?php echo ucfirst(Yii::$app->controller->id) ?>
                        <span class="material-symbols-outlined">
                        add
                    </span>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <hr class="border-t-2 border-main-accent mt-3">
</div>
