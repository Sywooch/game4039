<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\GameGift;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\GameGiftSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Game Gift');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-gift-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Game Gift'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			//'game_id',
			[
				'attribute' => 'game_server_id',
				'value' => function ($model)
				{
					return $model->gameServer->server_name;
				},
				'filter' => ArrayHelper::map(\common\models\GameServer::find()->all(), 'id', 'server_name'),
			],
			'lb_gid',
			'lb_name',
			// 'lb_type',
			// 'lb_method:ntext',
			// 'lb_content:ntext',
			// 'slug',
			// 'created_at',
			// 'updated_at',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => GameGift::getStatus(),
			],

			['class' => 'yii\grid\ActionColumn'],
		],
		'layout' => "{items}\n{summary}\n{pager}",
	]); ?>

</div>
