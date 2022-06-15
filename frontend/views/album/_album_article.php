<?php
/**
 * @var $articleText string
 */
?>
<?php if ($articleText): ?>
    <h1 class="font-sans text-5xl">Article</h1>
    <hr class="w-96 border-t-2 border-t-main-accent mt-2 mb-8">
    <div class="max-w-screen-lg article-style w-full text-justify">
        <?= $articleText ?>
    </div>

<?php endif; ?>