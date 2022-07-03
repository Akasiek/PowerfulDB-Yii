<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AlbumGenre */

$this->title = 'Create Album Genre';
$this->params['breadcrumbs'][] = ['label' => 'Album Genres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-genre-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
