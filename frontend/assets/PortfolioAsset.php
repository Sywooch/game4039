<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/22
 * Time: 11:31
 * Desc:
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class PortfolioAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';

	public $css = [
		//portfolio add css
		'unify/assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css',

		//为了减少引入css太多的问题,已经将其转移到custom.css文件中了
		//'unify/assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css',
	];

	public $js = [
		//portfolio add js
		'unify/assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js',
		//portfolio add js
		//'unify/assets/js/plugins/cube-portfolio/cube-portfolio-4.js',
	];

}