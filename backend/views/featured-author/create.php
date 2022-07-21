<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FeaturedAuthor */

$this->title = 'Create Featured Author';
$this->params['breadcrumbs'][] = ['label' => 'Featured Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="featured-author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
