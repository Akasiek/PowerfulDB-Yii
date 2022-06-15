<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\AlbumArticle */

$this->title = 'Create Album Article';
$this->params['breadcrumbs'][] = ['label' => 'Album Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<script>
    tinymce.init({
        selector: 'textarea',
    });
</script>
<div class="album-article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
