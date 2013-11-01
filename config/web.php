<?php
$params = require(__DIR__ . '/params.php');
$config = [
	'id' => 'bootstrap',
	'basePath' => dirname(__DIR__),
	'extensions' => require(__DIR__ . '/../vendor/yii-extensions.php'),
	'components' => [
		'request' => [
			'enableCsrfValidation' => true,
		],
//		'cache' => [
//			'class' => 'yii\caching\FileCache',
//		],
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
            'dsn' => 'mysql:host=localhost;dbname=YII2', // MySQL, MariaDB
            'username' => 'root',
            'password' => '9317',
            'charset' => 'utf8',
        ],	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	$config['preload'][] = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';
	$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
