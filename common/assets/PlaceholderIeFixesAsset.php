<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/21
 * Time: 11:07
 * Desc:
 */

namespace common\assets;


use yii\web\AssetBundle;

class PlaceholderIeFixesAsset extends AssetBundle
{
	public $sourcePath='@webroot/unify/assets';
	public $js=[
		'plugins/placeholder-IE-fixes.js',
	];
	public $jsOptions=[
		'condition' => 'lte IE9',
		'position' => \yii\web\View::POS_HEAD,
	];

}