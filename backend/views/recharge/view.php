<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Recharge */

$this->title = '充值详情-' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Recharge'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recharge-view">

	<p>
		<?php echo Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			//'id',
			[
				'attribute' => 'user_id',
				'value' => $model->user->username
			],
			[
				'attribute' => 'game_id',
				'value' => $model->game->name
			],
			[
				'attribute' => 'server_id',
				'value' => $model->server->server_name
			],
			'role_id',
			'amount',
			'order_id',
			'created_at:datetime',
			[
				'attribute' => 'status',
				'value' => \yii\helpers\ArrayHelper::getValue($model->getStatus(), $model->status),
			],
		],
	]) ?>

</div>
