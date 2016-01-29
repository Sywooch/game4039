<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\IndexSlide;

/* @var $this yii\web\View */
/* @var $model common\models\IndexSlide */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Index Slide'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-slide-view">

	<p>
		<?php echo Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			// 'id',
			[
				'attribute' => 'game_id',
				'value' => $model->game->name,
			],
			'name',
			'caption:html',
			'description:html',
			[
				'attribute' => 'thumbnail',
				'format' => 'html',
				'value' => Html::img(Yii::$app->glide->createSignedUrl([
					'glide/index',
					'path' => $model->thumbnail_path,

				], true), ['class' => 'img-responsive']),
			],
			'access_url:url',
			'official_url:url',
			//'thumbnail_base_url:url',
			//'thumbnail_path',
			'created_at:datetime',
			'updated_at:datetime',
			'sort',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue($model->getStatus(), $model->status),
			],
		],
	]) ?>

</div>
