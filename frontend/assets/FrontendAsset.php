<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{

	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $css = [
		/*
		 * CSS Global Compulsory
		 * */
		'unify/assets/css/style.css',

		/*
		 * CSS Header and Footer
		 * */
		//'unify/assets/css/headers/header-default.css',
		'unify/assets/css/headers/header-v8.css',


		'unify/assets/css/footers/footer-default.css',

		/*
		 * CSS Implementing Plugins
		 * */
		//'unify/assets/plugins/animate.css',
		'unify/assets/plugins/line-icons/line-icons.css',
		'unify/assets/plugins/font-awesome/css/font-awesome.min.css',

		/*
		 * Site CSS Theme
		 * */


		//'unify/assets/css/theme-colors/aqua.css',
		//'unify/assets/css/theme-colors/blue.css',
		//'unify/assets/css/theme-colors/brown.css',
		//'unify/assets/css/theme-colors/dark-blue.css',
		//'unify/assets/css/theme-colors/dark-red.css',
		//'unify/assets/css/theme-colors/default.css',
		//'unify/assets/css/theme-colors/light.css',
		//'unify/assets/css/theme-colors/light-green.css',
		//'unify/assets/css/theme-colors/orange.css',
		//'unify/assets/css/theme-colors/purple.css',
		//'unify/assets/css/theme-colors/red.css',
		'unify/assets/css/theme-colors/teal.css',

		/*
		 * CSS Implementing Plugins
		 * */
		'unify/assets/css/custom.css',
	];

	public $js = [
		/*
		 * JS Global Compulsory
		 * */
		//jquery.min.js
		//bootstrap.min.js
		//'unify/assets/plugins/jquery/jquery-migrate.min.js',

		/*
		 * JS Implementing Plugins
		 * */
		'unify/assets/plugins/back-to-top.js',
		//'unify/assets/plugins/smoothScroll.js',

		/*
		 * JS Customization
		 * */
		'unify/assets/js/custom.js',

		/*
		 * JS Page Level
		 * */
		'unify/assets/js/app.js',

	];

	public $depends = [
		'yii\web\YiiAsset',
		// 'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
		//	'frontend\assets\BootBoxAsset',
		'frontend\assets\LayerAsset',
		//'common\assets\Html5shivAsset',
		//'common\assets\RespondAsset',
		//'common\assets\PlaceholderIeFixesAsset',
		//slider depend
		'frontend\assets\SliderAsset',
		//Portfolio depend
		'frontend\assets\PortfolioAsset',
		//user depend
		'frontend\assets\UserAsset',
	];
}
