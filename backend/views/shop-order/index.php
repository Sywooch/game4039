<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\ShopOrder;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ShopOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Shop Order');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-order-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Shop Order'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'order_sn',
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

			['class' => 'yii\grid\ActionColumn'],
		],
		'layout' => "{items}\n{summary}\n{pager}",
	]); ?>

</div>
