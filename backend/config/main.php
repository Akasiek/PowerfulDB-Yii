<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/backend/user' => '/user/',

                '/backend/album' => '/album/',
                '/backend/album-article' => '/album-article/',
                '/backend/album-genre' => '/album-genre/',
                '/backend/track' => '/track/',
                '/backend/featured-author' => '/featured-author',

                '/backend/band' => '/band/',
                '/backend/band-article' => '/band-article/',
                '/backend/band-member' => '/band-member/',

                '/backend/artist' => '/artist/',
                '/backend/artist-article' => '/artist-article/',

                '/backend/genre' => '/genre/',
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ]
    ],
    'params' => $params,
];
