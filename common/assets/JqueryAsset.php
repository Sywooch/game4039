<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/21
 * Time: 18:07
 * Desc:
 */

namespace common\assets;


use yii\web\AssetBundle;

class JqueryAsset extends AssetBundle
{
	public $sourcePath = '@bower/jquery/dist';
	public $js = [
		'jquery.js',
	];
	public $jsOptions = [
		'position' => \yii\web\View::POS_HEAD
	];

}