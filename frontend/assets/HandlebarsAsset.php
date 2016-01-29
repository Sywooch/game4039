<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/29
 * Time: 19:24
 * Desc:
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class HandlebarsAsset extends AssetBundle
{
	public $sourcePath = '@bower/handlebars';
	public $js = [
		'handlebars.js',
	];
}