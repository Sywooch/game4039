<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\FriendsLinks;

/* @var $this yii\web\View */
/* @var $model common\models\FriendsLinks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Friends Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friends-links-view">

	<p>
		<?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
		<?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger btn-flat',
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
			'name',
			'url:url',
			[
				'attribute' => 'category',
				'value' => ArrayHelper::getValue(FriendsLinks::getCategory(),$model->category)
			],
			'description',
			'slug',
			'sort',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => FriendsLinks::STATUS_IN_USE == $model->status ? Yii::t('common', 'In Use') : Yii::t('common', 'Not Used'),
			],
		],
	]) ?>
</div>
