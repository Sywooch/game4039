<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/11
 * Time: 12:07
 * Desc:
 */
use yii\helpers\Html;

?>

<div class="col-md-4">
	<div class="product-img product-img-brd">
		<a href="#">
			<?=
			Html::img(Yii::$app->glide->createSignedUrl([
				'glide/index',
				'path' => $model->thumbnail_path,
				//'w' => 100
			], true), ['class' => 'full-width img-responsive']);
			?>
		</a>
		<?= Html::a('兑换礼包', ['view', 'slug' => $model->slug], ['class' => 'add-to-cart']) ?>
		<?php if ($model->is_hot != 0): ?>
			<div class="shop-rgba-dark-green rgba-banner">热门</div>
		<?php endif; ?>
	</div>
	<div class="product-description product-description-brd margin-bottom-30">
		<div class="overflow-h margin-bottom-5">
			<div class="pull-left">
				<h4 class="title-price"><a href=""><?= $model->title ?></a></h4>
				<span class="gender text-uppercase"><?= $model->category->title ?></span>
			</div>
			<div class="product-price">
				<span class="title-price"><?= $model->jifen . '积分' ?></span>
				<span class="title-price line-through">5000积分</span>
			</div>
		</div>
	</div>
</div>
