<?php

/** 
 * @model User
 */

use common\models\User;

$this->title = $model->username . ' Profile';
?>

<div class="pt-6 xl:pt-10 pb-28 px-6 lg:px-10 xl:px-12 2xl:px-16
            relative flex xl:flex-row flex-col
            gap-y-8 lg:gap-x-8 xl:gap-x-12 2xl:gap-x-16">

    <?= $this->render('_view_user_sidebar_card', [
        'model' => $model,
    ]) ?>

    <?= $this->render('_view_latest_contributions', [
        'model' => $model,
    ]) ?>

</div>