<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\RechargeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Recharge');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recharge-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => '充值',
		]), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			[
				'attribute' => 'user_id',
				'value' => function ($model)
				{
					return $model->user->username;
				}
			],
			[
				'attribute' => 'game_id',
				'value' => function ($model)
				{
					return $model->game->name;
				},
				'filter' => ArrayHelper::map(\common\models\Game::find()->statusInUse()->all(), 'id', 'name'),
			],
			[
				'attribute' => 'server_id',
				'value' => function ($model)
				{
					return $model->server->server_name;
				},
				'filter' => ArrayHelper::map(\common\models\GameServer::find()->statusInUse()->all(), 'id', 'server_name'),
			],
			//'role_id',
			 'amount',
			// 'order_id',
			//'created_at:datetime',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => \common\models\Recharge::getStatus(),
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
