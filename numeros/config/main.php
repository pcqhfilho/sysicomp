<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-numeros',
    'basePath' => dirname(__DIR__),
    'sourceLanguage' => 'pt-Br',
    'language' => 'pt-Br',
    //'timeZone' => 'America/Manaus',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'numeros\controllers',
    'components' => [
        'session' => [
            'name' => 'PHPnumerosSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
		'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
			'identityCookie' => [
                'name' => '_numerosUser', // unique for backend
            ]
        ],

        'view' => [
             'theme' => [
                 'pathMap' => [
                    //'@numeros/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-numeros/'
                    '@numeros/views' => '@numeros/views/adminLTE/yiisoft/yii2-numeros/'
                 ],
             ],
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
    ],
    'params' => $params,
];
