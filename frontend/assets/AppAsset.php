<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/reset.css',
        'css/output.css',
        'css/slimselect.css',
        'css/slimselect.min.css',
    ];
    public $js = [
        // Libraries initialization
        'js/isImage.js',
        'js/swiper.js',
        'js/slimselect.min.js',
        'js/slimselect.js',

        // Basic scripts
        'js/readmore.js',
        'js/sidebar.js',
        'js/filter_sort_main.js',
        'js/member_add.js',
        'js/track_add.js',
        'js/form_display_input_image.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
