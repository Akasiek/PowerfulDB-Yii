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
        'css/output.css',
    ];
    public $js = [
        'js/sidebar.js',
        'js/swiper.js',
        'js/isImage.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
