<?php

/** 
 * @model User
 */

use common\models\User;

?>

<div class="py-20 px-24 flex relative">

    <?= $this->render('_view_user_sidebar_card', [
        'model' => $model,
    ]) ?>

    <?= $this->render('_view_latest_contributions', [
        'model' => $model,
    ]) ?>

</div>