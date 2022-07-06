<?php

/**
 * @var $model Album | Band | Artist
 * @var $articleText string
 */

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;
use yii\helpers\Url;

$articleText = $model->getArticle()->asArray()->one()['text'] ?? '';

?>
<div>
    <h1 class="font-sans text-5xl">Article</h1>
    <hr class="max-w-sm  border-t-2 border-t-main-accent mt-2 mb-6">

    <?php if ($articleText) : ?>
        <div class="mx-auto article-style w-full text-justify">
            <?= $articleText ?>
        </div>
    <?php else : ?>
        <div class="article-style text-justify">
            <p>There is no article for this album yet.
                <?php if (!Yii::$app->user->isGuest) : ?>
                    You can go ahead and
                    <?= Html::a(
                        'create article for this ' . ($baseUrl ?? Yii::$app->controller->id),
                        ['/' . ($baseUrl ?? Yii::$app->controller->id) . '/article-create', 'slug' => $model->slug],
                        ['class' => 'hover:underline text-main-accent']
                    ) ?>
                <?php else : ?>
                    <?= Html::a(
                        'Log in to add it',
                        ['/login'],
                        ['class' => 'hover:underline text-main-accent']
                    ) ?>
                <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>

</div>