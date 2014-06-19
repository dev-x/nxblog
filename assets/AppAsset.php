<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/prettyPhoto.css',
		'css/site.css',
	];
	public $js = [
        'js/underscore.js',
        'js/backbone.js',
        //'https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js',
		'js/jquery.prettyPhoto.js',
        'js/jq.js',
	];
        
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
