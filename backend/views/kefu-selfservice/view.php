<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\KefuSelfservice;

/* @var $this yii\web\View */
/* @var $model common\models\KefuSelfservice */

$this->title = $model->sn;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Selfservice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-selfservice-view">

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

	<?php
	$attachmentsImags = '';
	foreach ($model->attachments as $ss)
	{
		$attachmentsImags .= Html::img(Yii::$app->glide->createSignedUrl([
			'glide/index',
			'path' => $ss['path'],
			'w' => 200
		], true), ['class' => 'img-responsive']);
	};
	?>
	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			//'id',
			'sn',
			[
				'attribute' => 'category_id',
				'value' => $model->category ? $model->category->title : null,
			],
			'game_role',
			[
				'attribute' => 'game_server',
				'value' => $model->gameServer ? $model->gameServer->server_name : null,
			],
			'email:email',
			'phone',
			[
				'attribute' => 'attachments',
				'format' => 'html',
				'value' => $attachmentsImags
			],
			'content:ntext',
			[
				'attribute' => 'user_id',
				'value' => $model->user ? $model->user->username : null,
			],
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(KefuSelfservice::getStatus(), $model->status)
			],
			[
				'attribute'=>'result',
				'format' => 'html',
				'value'=>"<div style='color:red;font-size:1.25em;'>".$model->result."</div>"
			],
		],
	]) ?>

</div>
