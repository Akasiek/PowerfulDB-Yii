<?php

/**
 * @var $model Artist | Band
 */

use common\models\Artist;
use common\models\Band;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$albums = $model->getAlbums()->orderBy('release_date')->all();
$albumsCount = count($albums);

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
                <?= Html::a('add', ['/album/create', Yii::$app->controller->id . '_id' => $model->id],
                    ['class' => 'material-symbols-rounded text-secondary-dark p-0.5 rounded-full bg-main-accent']) ?>
            </div>

            <div class="flex gap-4">

                <?= Html::button('grid_view', [
                    'class' => 'material-symbols-rounded !text-3xl',
                    'data-method' => 'post',
                    'data-pjax' => '1',
                    'data-params' => [
                        'displayStyle' => 'grid',
                    ],
                ]) ?>
                <?= Html::button('list', [
                    'class' => 'material-symbols-rounded !text-3xl',
                    'data-method' => 'post',
                    'data-pjax' => '1',
                    'data-params' => [
                        'displayStyle' => 'list',
                    ],
                ]) ?>

            </div>
        </div>
        <hr class="max-w-sm   border-t-2 border-t-main-accent mt-2 mb-6">
        <?php if ($albumsCount !== 0): ?>
            <?php if ($displayStyle === 'grid'): ?>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
                    <?php foreach ($albums as $album): ?>
                        <a href="<?= Url::to(['/album/view', 'slug' => $album->slug,]) ?>"
                           class="group transition">
                            <div class="text-center">
                                <img class="mb-2" src="<?= $album->artwork_url ?>" alt="Album artwork">

                                <p class="text-base lg:text-lg truncate group-hover:underline"
                                   title="<?= $album->title ?>">
                                    <?= $album->title ?>
                                </p>

                                <p class="text-sm truncate text-gray-400">
                                    <?= Yii::$app->formatter->asDate($album->release_date, 'Y') ?>
                                </p>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>

            <?php elseif ($displayStyle === 'list'): ?>

                <div class="flex flex-col justify-center items-center m-auto">
                    <?php $i = 0 ?>
                    <?php foreach ($albums as $album): ?>
                        <a href="<?= Url::to(['/album/view', 'slug' => $album->slug,]) ?>"
                           class="w-full">
                            <div class="flex justify-center items-center w-full">
                                <div class="h-36 m-10">
                                    <img src="<?= $album->artwork_url ?>" alt="Album artwork" class="h-full">

                                </div>

                                <div class="col-span-2 w-full flex-1">
                                    <h2 class="text-2xl"><?= $album->title ?></h2>
                                    <p class="italic text-gray-400">
                                        <?= Yii::$app->formatter->asDate($album->release_date, 'long') ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                        <?php if (++$i !== $albumsCount): ?>
                            <hr class="my-8 border-t-2 border-t-gray-700 w-[60%] mx-auto">
                        <?php endif ?>

                    <?php endforeach ?>
                </div>

            <?php endif ?>


        <?php else: ?>

            <div class="article-style text-justify">
                <p>This <?= Yii::$app->controller->id ?> has no albums yet. You can go ahead and
                    <?= Html::a('add album by this ' . ($baseUrl ?? Yii::$app->controller->id),
                        ['/album/create', Yii::$app->controller->id . '_id' => $model->id],
                        ['class' => 'underline hover:text-main-accent transition-colors']) ?>
                </p>
            </div>

        <?php endif; ?>
    </div>
<?php Pjax::end(); ?>