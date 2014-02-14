<?php
$params = require(__DIR__ . '/params.php');
$config = [
        'id' => 'bootstrap',
        'basePath' => dirname(__DIR__),
//        'extensions' => require(__DIR__ . '/../vendor/yii-extensions.php'),
        'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        //    'enableStrictParsing' => true,
            'rules'=>array(
                '' => 'site/index',
                'about' => 'site/about',
                'posts'=>'post/index',
                'post/<id:\d+>'=>'post/show',
                'users'=>'user/index',
                'users/<username:\w+>'=>'user/show',
                'users/<username:\w+>/posts'=>'post/index',
                'users/<username:\w+>/<action:\w+>'=>'user/<action>',

            ),
        ],
                'request' => [
                        'enableCsrfValidation' => true,
                ],
//                'cache' => [
//                        'class' => 'yii\caching\FileCache',
//                ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
                'user' => [
                        'identityClass' => 'app\models\User',
                ],
                'errorHandler' => [
                        'errorAction' => 'site/error',
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
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=nxblog', // MySQL, MariaDB
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],        ],
        'params' => $params,
];

if (YII_ENV_DEV) {
        $config['preload'][] = 'debug';
        $config['modules']['debug'] = 'yii\debug\Module';
        $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;