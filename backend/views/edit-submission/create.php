<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EditSubmission */

$this->title = 'Create Edit Submission';
$this->params['breadcrumbs'][] = ['label' => 'Edit Submissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edit-submission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
