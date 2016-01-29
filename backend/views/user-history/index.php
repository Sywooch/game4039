<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'User History');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-history-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
				},
			],
			[
				'attribute' => 'game_id',
				'value' => function ($model)
				{
					return $model->game->name;
				},
				'filter' => ArrayHelper::map(\common\models\Game::find()->all(), 'id', 'name'),
			],
			[
				'attribute' => 'server_id',
				'value' => function ($model)
				{
					return $model->server->server_name;
				},
				'filter' => ArrayHelper::map(\common\models\GameServer::find()->all(), 'id', 'server_name'),
			],
			'created_at:datetime',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => \common\models\UserHistory::getStatus(),
			],

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}{delete}',
			],
		],
	]); ?>

</div>
