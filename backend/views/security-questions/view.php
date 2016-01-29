<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\SecurityQuestions;

/* @var $this yii\web\View */
/* @var $model common\models\SecurityQuestions */

$this->title = $model->question;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Security Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="security-questions-view">

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
			'question',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(SecurityQuestions::getStatus(), $model->status),
			]
		],
	]) ?>

</div>
