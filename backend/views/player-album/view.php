<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\PlayerAlbum;

/* @var $this yii\web\View */
/* @var $model common\models\PlayerAlbum */

$this->title = $model->user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Player Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-album-view">

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
				'attribute' => 'user_id',
				'value' => $model->user->username,
			],
			//'thumbnail_base_url:url',
			//'thumbnail_path',
			[
				'attribute' => 'thumbnail',
				'format' => 'html',
				'value' => Html::img(Yii::$app->glide->createSignedUrl([
					'glide/index',
					'path' => $model->thumbnail_path,
					'w' => 100
				], true), ['class' => 'img-responsive']),
			],
			'url:url',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(PlayerAlbum::getStatus(), $model->status),
			],
		],
	]) ?>

</div>
