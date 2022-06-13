<?php
/**
 * @var $model Album
 */

use common\models\Album;

if ($model->artist_id) $author = $model->artist;
else $author = $model->band;

?>


<?php
echo $this->render('_album_jumbotron', [
    'model' => $model,
    'author' => $author,
]);
?>