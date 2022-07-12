<?php

/**
 * @var $model Album | Band | Artist
 * @var $articleText string
 */

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;

$articleText = $model->getArticle()->asArray()->one()['text'] ?? '';

?>
<div class="relative">
    <h1 class="section-title">Article</h1>
    <hr class="section-hr">

    <?php if ($articleText) : ?>
        <article class="mx-auto prose prose-invert lg:prose-xl h-96 w-full text-justify overflow-hidden" id="article">
            <?= $articleText ?>
        </article>
        <button id="read-more" class="absolute bottom-0 w-full flex h-16 items-end text-xl font-bold justify-center" style="background: linear-gradient(180deg, rgba(27, 28, 34, 0) 0%, #1B1C22 100%);">Read more</button>
        <button id="read-less" class="w-full flex justify-center text-xl font-bold hidden mt-2">Close article</button>
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