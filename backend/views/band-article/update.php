<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BandArticle */

$this->title = 'Update Band Article: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Band Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="band-article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
