<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\Activity;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Activity'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view">

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
				'value' => $model->category->title,
			],
			[
				'attribute' => 'relation_game_id',
				'value' => $model->game->name,
			],
			'title',
			'description:ntext',
			'url:url',
			'start_time:datetime',
			'end_time:datetime',
			'guize:html',
			'jiangli:html',
			'jiangli_fangfa:html',
			//'thumbnail_base_url:url',
			//'thumbnail_path',
			[
				'attribute' => 'thumbnail',
				'format' => 'html',
				'value' => Html::img($model->getThumbnailUrl(), ['class' => 'img-responsive']),
			],
			//'bg_image_base_url',
			//'bg_image_path',
			[
				'attribute' => 'bg_image',
				'format' => 'html',
				'value' => Html::img($model->getBgUrl(), ['class' => 'img-responsive']),
			],
			'content:html',
			'slug',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(Activity::getStatus(), $model->status),
			],
		],
	]) ?>

</div>
