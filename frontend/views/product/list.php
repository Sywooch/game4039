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
$queryCatId = Yii::$app->request->getQueryParams()['ShopProductSearch']['category_id'];
?>

<?php $this->render('_breadcrumbs') ?>

<div class="content container">
	<div class="row">
		<div class="col-md-3 filter-by-block md-margin-bottom-60">
			<?php include_once('_leftPanel.php')?>
		</div>

		<div class="col-md-9">
			<div class="row margin-bottom-5">
				<div class="col-sm-4 result-category">
					<h2><?= ShopCategory::findOne($queryCatId)->title ?></h2>
					<small
						class="shop-bg-red badge-results"><?= Buuug7Util::getOnSaleProductCount($queryCatId) ?></small>
				</div>
				<div class="col-sm-8">
					<ul class="list-inline clear-both">
						<li class="sort-list-btn">
							<h3>排序 :</h3>

							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									所有 <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">所有</a></li>
									<li><a href="#">积分</a></li>
									<li><a href="#">上架时间</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!--/end result category-->

			<div class="filter-results">
				<div class="row illustration-v2 margin-bottom-30">
					<?php echo \yii\widgets\ListView::widget([
						'dataProvider' => $dataProvider,
						'layout' => "{items}",
						'pager' => [
							'hideOnSinglePage' => true,
						],
						'itemView' => '_item'
					]) ?>
				</div>
			</div>
			<!--/end filter resilts-->

			<div class="text-center">
				<?= \yii\widgets\LinkPager::widget([
					'pagination' => $dataProvider->pagination,
				]) ?>
			</div>
			<!--/end pagination-->
		</div>
	</div>
	<!--/end row-->
</div>


<?php
$js = <<<JS
jQuery(document).ready(function() {
//make user-nav active
$('.index-nav').removeClass('active');
$('.shangcheng-nav').addClass('active');

        App.init();
    });
JS;
$this->registerJs($js);
$this->registerCssFile('/unify/assets/css/shop.style.css');
?>
