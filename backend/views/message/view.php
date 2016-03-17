<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Site Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//myVarDump(\common\models\Message::findUnreadMessagesByUserId(3));
//myVarDump(\common\models\Message::removeUnreadByUserId(3, 3));
?>
<div class="message-view">

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
			//'id',
			'title',
			[
				'attribute' => 'receive',
				'value' => ArrayHelper::getValue(\common\models\Message::getReceive(), $model->receive)
			],
			'unread:ntext',
			'sender',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(\common\models\Message::getStatus(), $model->status),
			],
			'deleted',
			'content:html',
		],
	]) ?>

</div>
