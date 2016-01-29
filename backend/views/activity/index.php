<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\Activity;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Activity');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Activity'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			[
				'attribute' => 'category_id',
				'value' => function ($model)
				{
					return $model->category ? $model->category->title : null;
				},
				'filter' => ArrayHelper::map(\common\models\ActivityCategory::find()->all(), 'id', 'title')
			],
			//'relation_game_id',
			'title',
			//'description:ntext',
			//'url:url',
			'start_time:datetime',
			'end_time:datetime',
			//'guize:html',
			//'jiangli:html',
			//'jiangli_fangfa:html',
			// 'thumbnail_base_url:url',
			// 'thumbnail_path',
			//'bg_image_base_url',
			//'bg_image_path',
			[
			    'attribute'=>'thumbnail',
				'format' => 'html',
			    'value'=>function($model){
					return Html::img($model->getThumbnailUrl(),['class' => 'img-responsive','styles'=>'width:100px;']);
				}
			],
			// 'content:ntext',
			// 'slug',
			//'created_at:datetime',
			// 'updated_at',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => Activity::getStatus(),
			],
			'sort',

			['class' => 'yii\grid\ActionColumn'],
		],
		'layout' => "{items}\n{summary}\n{pager}",
	]); ?>

</div>
