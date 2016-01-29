<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\KefuSelfservice;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\KefuSelfserviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Kefu Selfservice');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="kefu-selfservice-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Kefu Selfservice'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'sn',
			[
				'attribute' => 'game_server',
				'value' => function ($model)
				{
					return \common\models\GameServer::findOne($model->game_server)['server_name'];
				},
				'filter' => ArrayHelper::map(\common\models\GameServer::find()->all(), 'id', 'server_name'),
			],
			'game_role',
			[
				'attribute' => 'category_id',
				'value' => function ($model)
				{
					return $model->category ? $model->category->title : null;
				},
				'filter' => ArrayHelper::map(\common\models\KefuSelfserviceCat::find()->all(), 'id', 'title')
			],
			// 'email:email',
			// 'phone',
			// 'result:ntext',
			// 'thumbnail_base_url:url',
			// 'thumbnail_path',
			// 'content:ntext',
			// 'user_id',
			'created_at:datetime',
			// 'updated_at',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => KefuSelfservice::getStatus(),
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
