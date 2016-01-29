<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\GameGift;

/* @var $this yii\web\View */
/* @var $model common\models\GameGift */

$this->title = $model->lb_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Game Gift'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-gift-view">

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
			//'game_id',
			'game_server_id',
			'lb_gid',
			'lb_name',
			'lb_type',
			'lb_method:ntext',
			'lb_content:ntext',
			'slug',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(GameGift::getStatus(), $model->status),
			],
		],
	]) ?>

</div>
