<?php
/**
 * @var $content string
 */

$this->beginContent('@frontend/views/layouts/base.php');
?>

<div class="flex relative ml-72">

    <div class="fixed top-0 left-0 z-50">
        <?php echo $this->render('sidebar/_sidebar'); ?>
    </div>

    <main role="main" class="w-full z-10">
        <?= $content ?>
    </main>

</div>

<?php $this->endContent(); ?>
