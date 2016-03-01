<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/22
 * Time: 11:27
 * Desc:
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class SliderAsset extends AssetBundle
{

	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $css = [
		//slider add css
		//'unify/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css',
		'unify/assets/plugins/revolution-slider/rs-plugin/css/settings.min.css',
	];

	public $js = [
		//slider add js
		//'unify/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js',
		'unify/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js',
		'unify/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js',
		//slider add js
		//'unify/assets/js/plugins/owl-carousel.js',
		//'unify/assets/js/plugins/revolution-slider.js',
	];

}