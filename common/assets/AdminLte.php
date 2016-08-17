<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/2/14
 * Time: 11:40 AM
 */

namespace common\assets;

use yii\web\AssetBundle;

class AdminLte extends AssetBundle
{
    public $sourcePath = '@bower/admin-lte';
    public $js = [
        'bootstrap/js/bootstrap.js',
        'dist/js/app.min.js',
    ];

	/*
	 * 由于google fonts 字体的在线引用极不稳定,时不时被墙
	 * 所以去掉了AdminLTE CSS 文件中的google fonts的引用
	 * 该文件转移到BackendAsset.php文件中进行管理
	 *
	 * */
    public $css = [
        'bootstrap/css/bootstrap.css',
        //'dist/css/AdminLTE.min.css',
       // 'dist/css/skins/_all-skins.min.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
        'common\assets\FontAwesome',
        'common\assets\JquerySlimScroll'
    ];
}
