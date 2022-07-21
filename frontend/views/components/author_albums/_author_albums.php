<?php

/**
 * @var $model Artist | Band
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use \yii\data\ArrayDataProvider;

/** 
 * Get LPs and create data provider for them
 * Get also any other albums by author and group them by their type
 */
$LPsDataProvider = new ArrayDataProvider([
    'allModels' => $model
        ->getLPs()
        ->orderBy('release_date DESC')
        ->with('genres')
        ->all(),
    'pagination' => [
        'pageSize' => 12,
    ],
]);

$otherAlbums = $model
    ->getOtherAlbums()
    ->orderBy('release_date DESC')
    ->with('genres')
    ->all();

$otherAlbumsGroup = [];
foreach ($otherAlbums as $album) {
    $otherAlbumsGroup[$album->type][] = $album;
}


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

<!-- Section for Long Play Albums -->
<?php Pjax::begin(['id' => 'album-display-style-pjax']); ?>
<div class="w-full m-auto">
    <div class="flex gap-5 justify-between items-center">

        <div class="flex items-center gap-2 md:gap-4">
            <h1 class="section-title">Long Play Albums</h1>
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

    <?php if (count($LPsDataProvider->allModels) !== 0) : ?>

        <?= ListView::widget([
            'dataProvider' => $LPsDataProvider,
            'itemView' => $displayStyle === 'grid' ? '_author_albums_grid' : '_author_albums_list',
            'layout' => $displayStyle === 'grid' ? '<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3
                lg:grid-cols-4 gap-x-4 lg:gap-x-6 xl:gap-x-8 gap-y-6 md:gap-y-12">{items}</div>{pager}'
                : '<div class="flex flex-col justify-center items-center m-auto">{items}</div>{pager}',
            'itemOptions' => [
                'class' => 'w-full mx-auto',
            ],
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
        ]) ?>

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

<!-- Section for all other albums -->
<?php foreach ($otherAlbumsGroup as $type => $data) : ?>
    <div class="w-full m-auto">

        <h1 class="section-title"><?= $type . 's' ?></h1>
        <hr class="section-hr">

        <?php
        // Create data provider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);
        ?>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_author_albums_grid',
            'layout' => '<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3
                lg:grid-cols-4 gap-x-4 lg:gap-x-6 xl:gap-x-8 gap-y-6 md:gap-y-12">{items}</div>{pager}',
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
        ]) ?>

    </div>


<?php endforeach; ?>