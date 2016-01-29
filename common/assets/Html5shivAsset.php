<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/9/15
 * Time: 17:40
 * Desc: Asset buddle for html5shiv,The HTML5 Shiv enables use of HTML5 sectioning elements in legacy Internet Explorer and provides basic HTML5 styling for Internet Explorer 6-9, Safari 4.x (and iPhone 3.x), and Firefox 3.x.

 */

namespace common\assets;


use yii\web\AssetBundle;

class Html5shivAsset extends AssetBundle{
    public $sourcePath='@bower/html5shiv';
    public $jsOptions = [
        'condition' => 'lte IE9',
        'position' => \yii\web\View::POS_HEAD
    ];
    public $css=[];
    public $js=[
        'dist/html5shiv.min.js'
    ];
}