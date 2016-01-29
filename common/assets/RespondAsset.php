<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/9/16
 * Time: 8:41
 * Desc: A fast & lightweight polyfill for min/max-width CSS3 Media Queries (for IE 6-8, and more)
 */

namespace common\assets;


use yii\web\AssetBundle;

class RespondAsset extends AssetBundle{
    public $sourcePath='@bower/respond';
    public $js=[
        'dest/respond.min.js',
    ];
    public $jsOptions=[
        'condition' => 'lte IE9',
        'position' => \yii\web\View::POS_HEAD,
    ];
}