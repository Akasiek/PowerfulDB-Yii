<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FeaturedAuthor */

$this->title = 'Update Featured Author: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Featured Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="featured-author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
