<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\Game;

/* @var $this yii\web\View */
/* @var $model common\models\Game */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Games'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-view">

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
			[
				'attribute' => 'category_id',
				'value' => \common\models\GameCategory::find()->where(['id' => $model->category_id])->one()['title'],
			],
			'name',
			'description:ntext',
			'short',
			'api_key',
			'factory',
			'cname',
			//'thumbnail_base_url:url',
			//'thumbnail_path',
			[
				'attribute' => 'thumbnail',
				'format' => 'html',
				'value' => Html::img(Yii::$app->glide->createSignedUrl([
					'glide/index',
					'path' => $model->thumbnail_path,
					//'w' => 200
				], true), ['class' => 'img-responsive'])
			],
			[
				'attribute' => 'bg_image',
				'format' => 'html',
				'value' => Html::img(Yii::$app->glide->createSignedUrl([
					'glide/index',
					'path' => $model->bg_image_path,
					//'w' => 200
				], true), ['class' => 'img-responsive'])
			],
			'coin',
			'coin_rate',
			'game_web_url:url',
			'game_bbs_url:url',
			'api_secret',
			'api_server',
			'api_play',
			'api_pay',
			'api_check',
			'api_order',
			'q',
			[
				'attribute' => 'attr',
				'value' => ArrayHelper::getValue(Game::getAttr(), $model->attr),
			],
			[
				'attribute' => 'is_recommend',
				'value' => \common\models\Game::IS_RECOMMEND_YES == $model->is_recommend ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],
			'slug',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => \common\models\Game::STATUS_IN_USE == $model->status ? Yii::t('common', 'In Use') : Yii::t('common', 'Not Used'),
			],
			'sort',
		],
	]) ?>

</div>
