<?php
?>

<div class="py-14 px-20">
    <form method="POST">

        <h1 class="text-5xl font-sans mb-8">Add an artist</h1>

        <div class="flex flex-col gap-10 w-[30rem]">

            <p><b class="text-red-500">Warning:</b> Artist can be only a solo artist or a band.<br>
                If you want to add a <b>musician</b> that belongs to an artist go
                <a class="text-main-accent hover:underline"
                   href="<?php echo \yii\helpers\Url::to('member/create') ?>">here</a>
            </p>

            <?php
            echo $this->render('@frontend/views/form/_input_text', [
                'label' => 'Artist name',
                'id' => 'artist-name',
                'name' => 'artist-name',
                'placeholder' => 'Iron Maiden',
            ])
            ?>

            <?php
            echo $this->render('@frontend/views/form/_input_text', [
                'label' => 'Background image',
                'id' => 'bgImgUrl',
                'name' => 'background-image-url',
                'placeholder' => 'Url',
            ])
            ?>

            <img src="<?php echo Yii::getAlias('@web/resources/images/no_image.jpg') ?>" id="userImg"
                 class="w-full aspect-[315/175] object-cover object-center" alt="image uploaded by the user"/>

            <div class="text-right">
                <input type="submit" value="Submit"
                       class="bg-main-accent py-2 px-5 rounded-3xl text-secondary-dark font-bold cursor-pointer ">
            </div>
        </div>
    </form>
</div>

<script>
    const bgImgUrl = document.getElementById('bgImgUrl');
    const userImg = document.getElementById('userImg');

    bgImgUrl.addEventListener('input', (e) => {
        const url = e.target.value;
        if (isImage(url)) userImg.src = url;
        else userImg.src = '<?php echo Yii::getAlias('@web/resources/images/no_image.jpg') ?>';
    });
</script>
