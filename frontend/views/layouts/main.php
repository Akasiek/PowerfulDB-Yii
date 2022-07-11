<?php

/**
 * @var $content string
 */

$this->beginContent('@frontend/views/layouts/base.php');
?>

<div class="flex flex-col relative  mt-14 md:mt-0 md:ml-56 lg:ml-72">

    <div class="fixed top-0 left-0 z-50">
        <?php echo $this->render('sidebar/sidebar'); ?>
    </div>

    <main role="main" class="w-full min-h-screen z-10">
        <?= $content ?>
    </main>

    <footer class="mt-10 w-full z-10">
        <?= $this->render('footer'); ?>
    </footer>

</div>

<?php $this->endContent(); ?>