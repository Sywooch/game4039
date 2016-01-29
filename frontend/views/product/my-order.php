<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/14
 * Time: 13:06
 * Desc:
 */

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\ShopOrder;

$this->title = '4039 我的订单';

//获得侧边视图地址
$aside = dirname(__DIR__) . '/aside';

?>

<?php $this->render('_breadcrumbs') ?>

	<div class="container content">
		<div class="headline">
			<a href="<?= Url::toRoute(['product/my-order']) ?>"><h2>我的订单</h2></a>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<?php echo \yii\grid\GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],

						//'id',
						'order_sn',
						[
							'attribute' => '名称',
							'value' => function ($model)
							{
								return \common\models\ShopOrderItem::findOne(['order_id'=>$model->id])->title;
							}
						],
						[
							'attribute' => 'user_id',
							'value' => function ($model)
							{
								return $model->user ? $model->user->username : null;
							}
						],

						//'updated_at',
						'phone',
						'created_at:datetime',
						//'address:ntext',
						// 'email:email',
						// 'notes:ntext',
						[
							'class' => \common\grid\EnumColumn::className(),
							'attribute' => 'status',
							'enum' => ShopOrder::getStatus(),
						],

						[
							'class' => 'yii\grid\ActionColumn',
							'template' => '{delete}',
							'buttons' => [
								'delete' => function ($url, $model, $key)
								{
									return Html::a('<span class="glyphicon glyphicon glyphicon-trash"></span>', ['/product/my-order-delete','id' => $model->id,]);
								},
							],
						],
					],
					'layout' => "{items}\n{summary}\n{pager}",
				]); ?>
			</div>
		</div>
	</div>


<?php
$js = <<<JS

//make user-nav active
$('.index-nav').removeClass('active');
$('.shangcheng-nav').addClass('active');
App.init();
JS;
$this->registerJs($js);
$this->registerCssFile('/unify/assets/css/shop.style.css');
