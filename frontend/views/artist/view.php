<?php
/**
 * @var $model Artist
 */

use common\models\Artist;

?>


<?php
echo $this->render('_artist_jumbotron', [
    'model' => $model,
]);
?>