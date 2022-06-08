<?php
/**
 * @var $label string
 * @var $id string
 * @var $name string
 * @var $placeholder string
 */

?>

<div class="flex flex-col gap-4">
    <label for="<?php echo $name ?>" class="text-2xl">
        <?php echo $label ?>
    </label>
    <input type="text" name="<?php echo $name ?>" id="<?php echo $id ?>"
           class=" rounded-3xl bg-secondary-dark border-2 border-main-accent px-4 py-2
                        focus:outline-0 focus:shadow-accent transition duration-150
                        placeholder:text-gray-600"
           placeholder="<?php echo $placeholder ?>">
</div>
