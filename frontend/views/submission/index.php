<?php
/**
 * @var $dataProvider ActiveDataProvider
 */

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

$this->title = "Submissions Panel";
?>
<div class="w-full mx-auto px-6 lg:px-14 py-8">
    <h1 class="section-title">Submission panel</h1>
    <hr class="section-hr">
    <div class="w-full text-sm md:text-lg">
        <div class="submission-table-row font-bold">
            <p title="Table[column]">Table[column]</p>
            <p title="Element">Element</p>
            <p title="Old Data">Old Data</p>
            <p title="New Data">New Data</p>
            <p title="Editor">Editor</p>
            <p title="View submission">View submission</p>
        </div>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'pager' => [
                'options' => [
                    'class' => 'my-8 mx-auto flex rounded-lg bg-main-dark w-fit overflow-hidden',
                ],
                'linkOptions' => [
                    'class' => 'flex justify-center items-center py-3 px-4',
                ],
                'pageCssClass' => 'flex hover:opacity-60',
                'disabledPageCssClass' => 'py-3 px-4 text-gray-500',
                'activePageCssClass' => 'bg-secondary-accent',
                'maxButtonCount' => 6,
            ],
            'itemView' => '_submission_card',
            'layout' => '{items}{pager}',
        ]) ?>
    </div>
</div>
