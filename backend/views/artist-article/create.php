<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArtistArticle */

$this->title = 'Create Artist Article';
$this->params['breadcrumbs'][] = ['label' => 'Artist Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artist-article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
