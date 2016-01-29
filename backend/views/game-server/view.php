<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\GameServer;

/* @var $this yii\web\View */
/* @var $model common\models\GameServer */

$this->title = $model->server_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Game Server'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-server-view">

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
			'server_id',
			'server_name',
			[
				'attribute' => 'game_id',
				'value' => $model->game->name,
			],
			'server_key',
			'start_time:datetime',
			'slug',
			[
				'attribute' => 'is_shutdown',
				'value' => GameServer::IS_SHUT_DOWN_YES == $model->is_shutdown ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],

			[
				'attribute' => 'is_recommend',
				'value' => GameServer::IS_RECOMMEND_YES == $model->is_recommend ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],
			[
				'attribute' => 'is_hot',
				'value' => GameServer::IS_HOT_YES == $model->is_hot ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],
			[
				'attribute' => 'is_new',
				'value' => GameServer::IS_NEW_YES == $model->is_new ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(GameServer::getStatus(), $model->status),
			],
		],
	]) ?>

</div>
