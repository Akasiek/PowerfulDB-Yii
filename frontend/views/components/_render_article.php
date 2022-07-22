<?php

/**
 * @var $model Album | Band | Artist
 * @var $articleText string
 */

use common\models\Album;
use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;

$article = $model->getArticle()->one() ?? '';

?>
<div class="relative" id="article">
    <h1 class="section-title">Article</h1>
    <hr class="section-hr">

    <?php if ($article) : ?>
        <article class="mx-auto prose prose-invert lg:prose-xl h-96 w-full text-justify overflow-hidden" id="article">
            <?= $article->text ?>
            <p class="italic">
                Source:
                <?php if ($article->source_url) {
                    echo Html::a($article->source, $article->source_url, [
                        'target' => '_blank',
                        'class' => 'hover:underline no-underline',
                        'rel' => 'noopener noreferrer'
                    ]);
                } else {
                    echo $article->source;
                } ?>
            </p>
        </article>
        <button type="button" id="read-more"
                class="absolute bottom-0 w-full flex h-16 items-end text-xl font-bold justify-center"
                style="background: linear-gradient(180deg, rgba(27, 28, 34, 0) 0%, #1B1C22 100%);">Read more
        </button>
        <button type="button" id="read-less" class="w-full justify-center text-xl font-bold hidden mt-2">Close article
        </button>
    <?php else : ?>
        <div class="article-style text-sm md:text-base text-justify">
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