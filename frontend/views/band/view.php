<?php
/**
 * @var $model Band
 */

use common\models\Band;

?>

<?php
echo $this->render('@frontend/views/components/_default_jumbotron', [
    'model' => $model,
]);
?>
