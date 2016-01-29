<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\ShopOrder;

/* @var $this yii\web\View */
/* @var $model common\models\ShopOrder */

$this->title = $model->order_sn;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Shop Order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->order_sn;
?>
<div class="shop-order-view">

	<p>
		<?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			//'id',
			'order_sn',
			[
				'attribute' => 'user_id',
				'value' => $model->user->username,
			],
			'created_at:datetime',
			'updated_at:datetime',
			'phone',
			'address:ntext',
			'email:email',
			'notes:ntext',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(ShopOrder::getStatus(), $model->status),
			],

		],
	]) ?>

	<div class="col-lg-12">
		<h4>该订单包含商品信息:</h4>
		<?php
		$orderItems = \common\models\ShopOrderItem::find()->where(['order_id' => $model->id])->all();
		?>
		<?php foreach ($orderItems as $k => $v): ?>
			<?= DetailView::widget([
				'model' => $v,
				'attributes' => [
					//'order_id',
					'title',
					'price',
					'product_id',
					'quantity',
				]
			]) ?>
		<?php endforeach; ?>
	</div>

</div>
