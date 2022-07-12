<?php

/**
 * @var $model Artist | Band
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$albums = $model
    ->getAlbums()
    ->orderBy('release_date DESC')
    ->with('genres')
    ->all();


$cookies = Yii::$app->request->cookies;
// Check if display style is stored in cookies
$displayStyle = $cookies->getValue('displayStyle');
// If not, use the default display style and create a cookie
if (!$displayStyle) {
    $displayStyle = 'grid';
    Yii::$app->response->cookies->add(new \yii\web\Cookie([
        'name' => 'displayStyle',
        'value' => $displayStyle,
    ]));
}
// If pjax send a new display style, use it and create a cookie
if (Yii::$app->request->isPjax && Yii::$app->request->post('displayStyle')) {
    $displayStyle = Yii::$app->request->post('displayStyle');
    Yii::$app->response->cookies->add(new \yii\web\Cookie([
        'name' => 'displayStyle',
        'value' => $displayStyle,
    ]));
}

?>

<?php Pjax::begin(['id' => 'album-display-style-pjax']); ?>
<div class="w-full m-auto">
    <div class="flex gap-5 justify-between items-center">

        <div class="flex items-center gap-2 md:gap-4">
            <h1 class="section-title">Albums</h1>
            <?php if (!Yii::$app->user->isGuest) {
                echo Html::a(
                    'add',
                    ['/album/create', Yii::$app->controller->id . '_id' => $model->id],
                    ['class' => 'material-symbols-rounded text-secondary-dark scale-90 md:scale-100 md:p-0.5 rounded-full bg-main-accent']
                );
            } ?>
        </div>

        <div class="flex gap-2 md:gap-4">
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
    <hr class="section-hr">
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
                        'add album by this ' . ($model instanceof Artist ?  'artist' : 'band'),
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