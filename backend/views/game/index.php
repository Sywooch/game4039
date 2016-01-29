<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\Game;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\GameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Games');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Game'),
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
				'filter' => ArrayHelper::map(\common\models\GameCategory::find()->all(), 'id', 'title')
			],
			'name',
			//'description',
			'short',
			//'api_key',
			//'factory',
			//'cname',
			[
				'attribute' => 'thumbnail',
				'format' => 'html',
				'value' => function ($model)
				{
					return Html::img(Yii::$app->glide->createSignedUrl([
						'glide/index',
						'path' => $model->thumbnail_path,
						'w' => 150
					], true), ['class' => 'img-responsive']);
				}

			],
			//'coin',
			//'coin_rate',
			//'game_web_url',
			//'game_bbs_url',
			//'api_secret',
			//'api_server',
			//'api_play',
			//'api_pay',
			//'api_check',
			//'api_order',
			//'q',
			//'slug',
			[
				'attribute' => 'attr',
				'value' => function ($model)
				{
					return ArrayHelper::getValue(Game::getAttr(), $model->attr);
				},
				'filter' => Game::getAttr(),
			],
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => [
					Yii::t('common', 'Not Used'),
					Yii::t('common', 'In Use')
				]
			],
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'is_recommend',
				'enum' => [
					Yii::t('common', 'Not'),
					Yii::t('common', 'Yes')
				],
			],
			'sort',

			['class' => 'yii\grid\ActionColumn'],
		],
		'layout' => "{items}\n{summary}\n{pager}",
	]); ?>

</div>
