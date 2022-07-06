<?php

/**
 * @var $model Artist | Band
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$albums = $model->getAlbums()->orderBy('release_date DESC')->all();

// Check if pjax send a new display style
$displayStyle = Yii::$app->cache->get('album_display_style');
// If not, use the default display style
if ($displayStyle === false) {
    $displayStyle = 'grid';
    Yii::$app->cache->set('album_display_style', $displayStyle);
}
// If pjax send a new display style, use it
if (Yii::$app->request->isPjax && Yii::$app->request->post('displayStyle')) {
    $displayStyle = Yii::$app->request->post('displayStyle');
    Yii::$app->cache->set('album_display_style', $displayStyle);
}

?>

<?php Pjax::begin(['id' => 'album-display-style-pjax']); ?>
<div class="w-full m-auto">
    <div class="flex gap-20 justify-between items-center">

        <div class="flex items-center gap-4">
            <h1 class="font-sans text-5xl">Albums</h1>
            <?php if (!Yii::$app->user->isGuest) {
                echo Html::a(
                    'add',
                    ['/album/create', Yii::$app->controller->id . '_id' => $model->id],
                    ['class' => 'material-symbols-rounded text-secondary-dark p-0.5 rounded-full bg-main-accent']
                );
            } ?>
        </div>

        <div class="flex gap-4">
            <?= Html::button('grid_view', [
                'class' => 'material-symbols-rounded !text-3xl' . ($displayStyle === 'grid' ? ' text-main-accent' : ''),
                'data-method' => 'post',
                'data-pjax' => '1',
                'data-params' => [
                    'displayStyle' => 'grid',
                ],
            ]) ?>
            <?= Html::button('list', [
                'class' => 'material-symbols-rounded !text-3xl' . ($displayStyle === 'list' ? ' text-main-accent' : ''),
                'data-method' => 'post',
                'data-pjax' => '1',
                'data-params' => [
                    'displayStyle' => 'list',
                ],
            ]) ?>

        </div>
    </div>
    <hr class="max-w-sm   border-t-2 border-t-main-accent mt-2 mb-6">
    <?php if (count($albums) !== 0) : ?>
        <?php if ($displayStyle === 'grid') : ?>

            <?= $this->render('_author_albums_grid', [
                'albums' => $albums,
            ]) ?>

        <?php elseif ($displayStyle === 'list') : ?>

            <?= $this->render('_author_albums_list', [
                'albums' => $albums,
            ]) ?>

        <?php endif; ?>


    <?php else : ?>

        <div class="article-style text-justify">
            <p>This <?= Yii::$app->controller->id ?> has no albums yet.
                <?php if (!Yii::$app->user->isGuest) : ?>

                    You can go ahead and
                    <?= Html::a(
                        'add album by this ' . ($baseUrl ?? Yii::$app->controller->id),
                        ['/album/create', Yii::$app->controller->id . '_id' => $model->id],
                        ['class' => 'hover:underline text-main-accent']
                    ) ?>
                <?php else : ?>
                    <?= Html::a(
                        'Log in to add them',
                        ['/login'],
                        ['class' => 'hover:underline text-main-accent']
                    ) ?>
                <?php endif; ?>

            </p>
        </div>

    <?php endif; ?>
</div>
<?php Pjax::end(); ?>