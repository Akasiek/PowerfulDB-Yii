<?php
/**
 * @var $contrib EditSubmission
 * @var $model User
 */

use common\models\EditSubmission;
use common\models\User;
use yii\helpers\Html;

?>

<?php if ($contrib->column === 'delete') : ?>
    <span class="material-symbols-rounded !text-lg xl:!text-xl">
        delete
    </span>
    <p>
        <?= $model->username . ' deleted '; ?>
        <span class="font-bold">
                        <?= str_replace('_', ' ', $contrib->table) ?>
                    </span>
        <span class="text-gray-500 italic hidden md:inline">
            + 1 points
        </span>
    </p>
<?php else: ?>
    <span class="material-symbols-rounded !text-lg xl:!text-xl">
        edit
    </span>
    <?php $element = $contrib->getElement(); ?>
    <p>
        <?= $model->username . ' edited ' ?>
        <span class="font-bold"><?= str_replace('_', ' ', $contrib->column) ?></span>
        <?= ' field in ' . str_replace('_', ' ', $contrib->table) ?>

        <!-- LINKS TO EDITED ELEMENTS OR THEIR PARENT -->
        <?php if (isset($element)) {
            if (in_array($contrib->table, ['album', 'artist', 'band'])) {
                // If edited were an album, artist or band
                echo Html::a(
                    $element->title ?? $element->name,
                    [$contrib->table . '/view', 'slug' => $element->slug],
                    ['class' => 'font-bold text-main-accent hover:underline']
                );
            } elseif (in_array($contrib->table, ['album_article', 'artist_article', 'band_article'])) {
                // If edited were articles
                $modelType = explode('_', $contrib->table)[0];
                echo ' in ' . $modelType . ' ';
                echo Html::a(
                    $element->{$modelType}->title ?? $element->{$modelType}->name,
                    [$modelType . '/view', 'slug' => $element->{$modelType}->slug],
                    ['class' => 'italic text-main-accent hover:underline']
                );
            } elseif ($contrib->table === 'track') {
                // If edited was a track
                echo ' in album ';
                echo Html::a(
                    $element->album->title,
                    ['album/view', 'slug' => $element->album->slug],
                    ['class' => 'italic text-main-accent hover:underline']
                );
            } elseif ($contrib->table === 'band_member') {
                // If edited was a band member
                echo ' in band ';
                echo Html::a(
                    $element->band->name,
                    ['band/view', 'slug' => $element->band->slug],
                    ['class' => 'italic text-main-accent hover:underline']
                );
            }
        } ?>

        <span class="text-gray-500 italic hidden md:inline">
            + 1 points
        </span>
    </p>
<?php endif; ?>
