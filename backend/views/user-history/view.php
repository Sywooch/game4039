<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\UserHistory;

/* @var $this yii\web\View */
/* @var $model common\models\UserHistory */

$this->title = $model->user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'User History'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-history-view">

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
				'value' => $model->user->username,
			],
			[
				'attribute' => 'game_id',
				'value' => $model->game->name,
			],
			[
				'attribute' => 'server_id',
				'value' => $model->server->server_name,
			],
			'created_at:datetime',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(UserHistory::getStatus(), $model->status),
			],
		],
	]) ?>

</div>
