<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/6/7
 * Time: 20:54
 * Desc:
 */

namespace common\assets;


use yii\web\AssetBundle;

class Bootstrap extends AssetBundle
{

    public $sourcePath = '@npm/bootstrap/dist';

    public $css = [
        'css/bootstrap.css'
    ];
    public $js = [
        'js/bootstrap.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

}