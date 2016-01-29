<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/14
 * Time: 11:39
 * Desc:
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class LayerAsset extends AssetBundle
{
	public $sourcePath = '@vendor/layer-v2.1/layer';

	public $js = [
		'layer.js'
	];

}