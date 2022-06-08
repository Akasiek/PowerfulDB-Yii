<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */

/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error flex flex-col items-center justify-center h-screen w-full">

    <h1 class="text-8xl text-main-accent font-sans"><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger text-3xl font-sans mb-8">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
