<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PlayerAlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Player Albums');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-album-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => '玩家相册',
		]), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			[
			    'attribute'=>'user_id',
			    'value'=>function($model){
					return $model->user->username;
				}
			],
			//'thumbnail_base_url:url',
			//'thumbnail_path',
			// 'url:url',
			'created_at:datetime',
			// 'updated_at',
			[
				'label' => Yii::t('common', 'Picture'),
				'format' => 'html',
				'value' => function ($model)
				{
					return Html::img(Yii::$app->glide->createSignedUrl([
						'glide/index',
						'path' => $model->thumbnail_path,
						'w' => 100
					], true), ['class' => 'img-responsive']);
				}
			],
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => [
					Yii::t('common', 'Not Active'),
					Yii::t('common', 'Active')
				]
			],

			['class' => 'yii\grid\ActionColumn'],
		],
		'layout' => "{items}\n{summary}\n{pager}",
	]); ?>

</div>
