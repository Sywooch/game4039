<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/14
 * Time: 10:55
 * Desc:
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class BootboxAsset extends AssetBundle
{

	public $sourcePath = '@bower/bootbox';

	public $js = [
		'bootbox.js'
	];

}