<?php
/**
 * @var $model Artist
 */

use common\models\Artist;

?>


<?php
echo $this->render('@frontend/views/components/_default_jumbotron', [
    'model' => $model,
]);
?>