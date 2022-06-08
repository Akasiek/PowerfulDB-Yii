<?php
/**
 * @var $model Artist
 */

use common\models\Artist;

?>


<?php
echo $this->render('components/_artist_jumbotron', [
    'model' => $model,
]);
?>