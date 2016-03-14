<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/12
 * Time: 9:42
 * Desc:
 */

use yii\helpers\Url;
use yii\bootstrap\Html;
use common\util\Buuug7Util;

use common\models\ShopCategory;

$this->title = '积分商城';
?>

<?php $this->render('_breadcrumbs') ?>

	<div class="content container">
		<div class="row">
			<div class="col-md-3 filter-by-block md-margin-bottom-60">
				<?php include_once('_leftPanel.php') ?>
			</div>

			<div class="col-md-9">
				<div class="row margin-bottom-5">
					<ul class="breadcrumb">
						<li><a href="<?= Url::to(['/site/index']) ?>">首页</a></li>
						<li><a href="<?= Url::to(['/product/index']) ?>">积分商城</a></li>
						<li class="active"><?= $model->title ?></li>
					</ul>

					<div class="col-md-6">
						<?= Html::img(Yii::$app->glide->createSignedUrl([
							'glide/index',
							'path' => $model->thumbnail_path,
						], true)) ?>
					</div>

					<div class="col-md-6">
						<div class="shop-product-heading">
							<h2><?= $model->title ?></h2>
						</div>
						<div class="sc-p-price margin-bottom-5">
							<span class="sc-p-price-now" title="370积分"><span><?= $model->jifen ?></span>积分</span>
							<span class="sc-p-price-discount"><span><?= 3000 / 5000 ?></span>折</span>
							<span class="sc-p-price-orgin" title="500积分"><s>5000积分</s></span>
							<a class="sc-p-price-btn" href="javascript:duihuan();" data-id="<?= $model->id ?>"
							   data-type="<?= $model->category->id ?>"
							   data-game="<?= $model->relation_game ?>"><i></i><span>立即兑换</span></a>
						</div>
						<p class="shop-rest">
							<span>已兑换：55 个</span>
							<span>库存：<?= $model->product_number ?> 个</span>
						</p>
					</div>
				</div>
				<!--/end result category-->

				<div class="filter-results">
					<div class="row illustration-v2 margin-bottom-30">
						<?= $model->content ?>
					</div>
				</div>
				<!--/end filter resilts-->
			</div>
		</div>
		<!--/end row-->
	</div>

<?php
$dataGame = $model->relation_game ? $model->relation_game : "null";
$js = <<<JS

//make user-nav active
$('.index-nav').removeClass('active');
$('.shangcheng-nav').addClass('active');
App.init();

duihuan=function(){
	var dataId={$model->id};
    var dataType={$model->category->id};
    var dataGame={$dataGame};
    $.ajax({
        		url:'/product/dui-huan',
        		type:'post',
        		data:{
        			dataId:dataId,
        			dataType:dataType,
        			dataGame:dataGame
        		},
        		success:function(data){
        		var obj=$.parseJSON(data);
        			//console.log(obj);
        			layer.alert(obj.msg);
        		}
        	});
}

JS;
$this->registerJs($js);
$this->registerCssFile('/unify/assets/css/shop.style.css');
