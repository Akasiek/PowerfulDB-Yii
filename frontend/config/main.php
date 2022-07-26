<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
                '/about' => '/site/about',
                '/login' => '/site/login',

                '/user/<id>' => '/user/view',

                '/artist/' => '/artist/index',
                '/artist/create' => '/artist/create',
                '/artist/<slug>' => '/artist/view',
                '/artist/<slug>/edit' => '/artist/edit',
                '/artist/<slug>/article/create' => '/artist/article-create',

                '/band/' => '/band/index',
                '/band/create' => '/band/create',
                '/band/<slug>' => '/band/view',
                '/band/<slug>/edit' => '/band/edit',
                '/band/<slug>/article/create' => '/band/article-create',
                '/band/<slug>/member/add' => '/band/member-add',

                '/album/' => '/album/index',
                '/album/create' => '/album/create',
                '/album/<slug>' => '/album/view',
                '/album/<slug>/edit' => '/album/edit',
                '/album/<slug>/article/create' => '/album/article-create',
                '/album/<slug>/genre/add' => '/album/genre-add',
                '/album/<slug>/genre/edit' => '/album/genre-edit',
                '/album/<slug>/track/create' => '/album/track-create',
                '/album/<slug>/track/add' => '/album/track-add',
                '/album/track/<id>/delete' => '/album/track-delete',
                '/album/<albumSlug>/track/<trackSlug>/edit' => '/album/track-edit',

                '/submission/view/<id>' => '/submission/view',
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ]
    ],
    'params' => $params,
];
