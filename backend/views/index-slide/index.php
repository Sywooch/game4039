<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\IndexSlide;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\IndexSlideSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Index Slide');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-slide-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Index Slide'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			[
				'attribute' => 'game_id',
				'value' => function ($model)
				{
					return $model->game->name;
				},
				'filter' => ArrayHelper::map(\common\models\Game::find()->statusInUse()->all(), 'id', 'name')
			],
			'name',
			'sort',
			//'caption:html',
			//'description:html',
			// 'access_url:url',
			// 'official_url:url',
			// 'thumbnail_base_url:url',
			// 'thumbnail_path',
			[
				'attribute' => 'thumbnail',
				'format' => 'html',
				'value' => function ($model)
				{
					return Html::img(Yii::$app->glide->createSignedUrl([
						'glide/index',
						'path' => $model->thumbnail_path,
						'w' => '600'
					], true), ['class' => 'img-responsive']);
				}
			],
			// 'created_at',
			// 'updated_at',

			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => IndexSlide::getStatus()
			],

			['class' => 'yii\grid\ActionColumn'],
		],
		'layout' => "{items}\n{summary}\n{pager}",
	]); ?>

</div>
