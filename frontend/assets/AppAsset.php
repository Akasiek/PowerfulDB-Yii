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
        'js/isImage.js',
        'js/swiper.js',
        'js/slimselect.min.js',
        'js/slimselect.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
