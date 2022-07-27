<?php

/**
 * @var $model Artist
 */

use common\models\Artist;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

// Wierd fix for pjax to not scroll to top
$this->registerJs('$.pjax.defaults.scrollTo = false;', \yii\web\View::POS_LOAD);

if (!isset($model)) throw new NotFoundHttpException('Artist not found');

$this->title = $model->name;
?>


<?php
echo $this->render('@frontend/views/components/_default_jumbotron', [
    'model' => $model,
]);
?>

<div class="flex flex-col gap-12 md:gap-16 px-5 md:px-10 lg:px-14 py-8 mx-auto max-w-screen-lg w-full">

    <?= $this->render('@frontend/views/components/_render_article', [
        'model' => $model,
    ]); ?>

    <?= $this->render('@frontend/views/components/author_albums/_author_albums', [
        'model' => $model,
    ]); ?>

    <?= $this->render('_view_artist_band_memberships', [
        'model' => $model,
    ]); ?>

    <?php if (!Yii::$app->user->isGuest) {
        echo Html::a('Edit artist', ['edit', 'slug' => $model->slug], [
            'class' => 'rounded-xl px-4 py-1 bg-main-accent text-secondary-dark font-bold w-fit',
        ]);
    } ?>
    
</div>