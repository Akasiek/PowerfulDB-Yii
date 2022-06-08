<?php
/**
 * @var $content string
 */

$this->beginContent('@frontend/views/layouts/base.php');
?>

<div class="flex relative">

    <main role="main" class="w-full">
        <?= $content ?>
    </main>

</div>

<?php $this->endContent(); ?>
