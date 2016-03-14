<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/11
 * Time: 9:26
 * Desc:
 */
use yii\helpers\Url;
use yii\bootstrap\Html;
use common\models\ShopProduct;
use common\util\Buuug7Util;
use common\models\ShopCategory;

$this->title = '积分商城';


$hotProduct = ShopProduct::find()->statusInUseAndOnSale()->andWhere(['is_hot' => ShopProduct::IS_HOT_YES])->all();
$xuniProduct = ShopProduct::find()->statusInUseAndOnSale()->andWhere(['category_id' => ShopCategory::findOne(['slug' => 'xu-ni-wu-pin'])->id])->all();
$shitiProduct = ShopProduct::find()->statusInUseAndOnSale()->andWhere(['category_id' => ShopCategory::findOne(['slug' => 'shi-ti-wu-pin'])->id])->all();

?>
<?php $this->beginBlock('slider') ?>
<div class="collection-banner">
	<div class="container">
		<div class="col-md-7 md-margin-bottom-50">
			<h2>积分商城</h2>

			<p>积分兑换好礼,丰富好礼等你来拿!</p><br>
		</div>
		<div class="col-md-5">
			<div class="overflow-h">
				<span class="percent-numb">50</span>

				<div class="percent-off">
					<span class="discount-percent">%</span>
					<span class="discount-off">折扣</span>
				</div>
				<div class="new-offers shop-bg-green rounded-x">
					<p>新</p>
					<span>礼包</span>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->endBlock(); ?>


<div class="content container">
	<div class="hot-product">
		<div class="heading heading-v1 margin-bottom-40">
			<h2>热门礼包</h2>
		</div>
		<div class="row illustration-v2 margin-bottom-40">
			<?php foreach ($hotProduct as $hp): ?>
				<div class="col-md-3 col-sm-6 md-margin-bottom-30">
					<div class="product-img">
						<?=
						Html::img(Yii::$app->glide->createSignedUrl([
							'glide/index',
							'path' => $hp->thumbnail_path,
							//'w' => 100
						], true), ['class' => 'full-width img-responsive']);
						?>
						<?= Html::a('兑换礼包', ['view', 'slug' => $hp->slug], ['class' => 'add-to-cart']) ?>

						<div class="shop-rgba-red rgba-banner">热门</div>
					</div>
					<div class="product-description product-description-brd">
						<div class="overflow-h margin-bottom-5">
							<div class="pull-left">

								<h4 class="title-price"><a href=""><?= $hp->title ?></a></h4>
								<span class="gender text-uppercase"><?= $hp->category->title ?></span>
							</div>
							<div class="product-price">
								<span class="title-price"><?= $hp->jifen . '积分' ?></span>
								<span class="title-price line-through">5000积分</span>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<!--/end hot product -->

	<div class="xuni-product">
		<div class="heading-v1">
			<h2>
				虚拟物品 <?= Html::a('<i class="fa  fa-plus-square"></i>', ['list', 'ShopProductSearch[category_id]' => ShopCategory::findOne(['slug' => 'xu-ni-wu-pin'])['id']]) ?></h2>
		</div>
		<div class="row illustration-v4 margin-bottom-40">
			<?php foreach ($xuniProduct as $hp): ?>
				<div class="col-md-3 col-sm-6">
					<div class="thumb-product">
						<a href="<?= Url::to(['/product/view', 'slug' => $hp->slug]) ?>">
							<?= Html::img(Yii::$app->glide->createSignedUrl([
								'glide/index',
								'path' => $hp->thumbnail_path,
							], true), ['class' => 'thumb-product-img']) ?>
						</a>

						<div class="thumb-product-in">
							<h4><?= Html::a($hp->title, ['view', 'slug' => $hp->slug]) ?></h4>
							<span class="thumb-product-type"><?= $hp->category->title ?></span>
						</div>
						<ul class="list-inline overflow-h">
							<li class="thumb-product-price"><?= $hp->jifen ?><span style="font-size: 13px;">积分</span>
							</li>
							<li class="thumb-product-price line-through"></li>

						</ul>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<!--/end xuni product -->

	<div class="shiti-product">
		<div class="heading-v1">
			<h2>
				实体物品 <?= Html::a('<i class="fa  fa-plus-square"></i>', ['list', 'ShopProductSearch[category_id]' => ShopCategory::findOne(['slug' => 'xu-ni-wu-pin'])['id']]) ?></h2>
		</div>
		<div class="row illustration-v4 margin-bottom-40">
			<?php foreach ($shitiProduct as $hp): ?>
				<div class="col-md-3 col-sm-6">
					<div class="thumb-product">
						<a href="<?= Url::to(['/product/view', 'slug' => $hp->slug]) ?>">
							<?= Html::img(Yii::$app->glide->createSignedUrl([
								'glide/index',
								'path' => $hp->thumbnail_path,
							], true), ['class' => 'thumb-product-img']) ?>
						</a>

						<div class="thumb-product-in">
							<h4><?= Html::a($hp->title, ['view', 'slug' => $hp->slug]) ?></h4>
							<span class="thumb-product-type"><?= $hp->category->title ?></span>
						</div>
						<ul class="list-inline overflow-h">
							<li class="thumb-product-price"><?= $hp->jifen ?><span style="font-size: 13px;">积分</span>
							</li>
							<li class="thumb-product-price line-through"></li>

						</ul>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<!--/end shiti product -->


</div>


<?php
$css = <<<CS
.collection-banner {
    background-image: url(../unify/assets/img/collection-bg.jpg);
}
CS;
$this->registerCss($css);

$js = <<<JS
//make user-nav active
$('.index-nav').removeClass('active');
$('.shangcheng-nav').addClass('active');

App.init();
JS;

$this->registerJs($js);
$this->registerCssFile('@web/unify/assets/css/shop.style.css');


