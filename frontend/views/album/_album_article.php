<?php
/**
 * @var $model Album
 * @var $articleText string
 */

use common\models\Album;

?>
<?php if ($articleText): ?>

    <h1 class="font-sans text-5xl">Article</h1>
    <hr class="max-w-sm border-t-2 border-t-main-accent mt-2 mb-8">
    <div class="max-w-screen-lg article-style w-full text-justify">
        <?= $articleText ?>
    </div>

<?php else: ?>

    <h1 class="font-sans text-5xl">Article</h1>
    <hr class="max-w-sm  border-t-2 border-t-main-accent mt-2 mb-6">
    <div class="article-style max-w-screen-lg text-justify">
        <p>There is no article for this album yet. You can go ahead and
            <?= \yii\helpers\Html::a('create article for this album',
                ['album-article/create', 'slug' => $model->slug],
                ['class' => 'underline hover:text-main-accent transition-colors']) ?>
        </p>
    </div>
<?php endif; ?>

