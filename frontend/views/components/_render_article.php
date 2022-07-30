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
<div class="relative" id="article-container">
    <div class="flex items-center gap-2 md:gap-4">
        <h1 class="section-title">Article</h1>

        <?php if (!Yii::$app->user->isGuest && isset($article->text)) {
            echo Html::a(
                Html::tag('span', 'edit', [
                    'class' => 'material-symbols-rounded text-secondary-dark !text-base md:!text-xl'
                ]),
                ['article-edit', 'slug' => $model->slug],
                ['class' => 'md:p-0.5 rounded-full bg-main-accent aspect-square
                h-6 md:h-8 flex items-center justify-center']
            );
        } ?>
    </div>
    <hr class="section-hr">

    <?php if ($article) : ?>
        <article class="mx-auto prose prose-invert lg:prose-xl h-96 w-full text-justify overflow-hidden" id="article">
            <?= $article->text ?>
            <?php if ($article->source || $article->source_url): ?>
                <p class="italic">
                    Source:
                    <?php if ($article->source_url) {
                        echo Html::a(($article->source ?: $article->source_url), $article->source_url, [
                            'target' => '_blank',
                            'class' => 'hover:underline no-underline',
                            'rel' => 'noopener noreferrer'
                        ]);
                    } else {
                        echo $article->source;
                    } ?>
                </p>
            <?php endif; ?>
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