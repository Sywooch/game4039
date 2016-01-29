<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\GameServer;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\GameServerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Game Server');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-server-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Game Server'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'server_id',
			'server_name',
			[
				'attribute' => 'game_id',
				'value' => function ($model)
				{
					return $model->game->name;
				},
				'filter' => ArrayHelper::map(\common\models\Game::find()->all(), 'id', 'name'),
			],
			//'server_key',
			'start_time:datetime',
			// 'slug',
			// 'is_new',
			// 'is_hot',
			// 'is_recommend',
			// 'is_shutdown',
			// 'created_at',
			// 'updated_at',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => [
					Yii::t('common', 'Not Used'),
					Yii::t('common', 'In Use')
				]
			],

			['class' => 'yii\grid\ActionColumn'],
		],
		'layout' => "{items}\n{summary}\n{pager}",
	]); ?>

</div>
