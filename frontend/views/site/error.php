<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */

/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="h-screen w-full flex flex-col items-center justify-center px-6
            text-center text-xs sm:text-sm md:text-base">

    <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl text-main-accent font-sans"><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger text-2xl md:text-3xl font-sans mb-4 md:mb-8">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>
    <a href="https://youtu.be/dQw4w9WgXcQ" class="text-gray-700 font-bold mt-1">
        ¯\_(ツ)_/¯
    </a>

</div>