<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\ShopProduct;

/* @var $this yii\web\View */
/* @var $model common\models\ShopProduct */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Shop Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-product-view">

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
			'title',
			[
				'attribute' => 'relation_game',
				'value' => $model->relationGame ? $model->relationgame->name : null
			],
			'slug',
			'description:ntext',
			[
				'attribute' => 'category_id',
				'value' => $model->category->title,
			],
			'price',
			'jifen',
			'content:html',
			'keywords',
			'thumbnail_base_url:url',
			'thumbnail_path',
			'img_base_url:url',
			'img_path',
			'product_number',
			'return_jifen',
			[
				'attribute' => 'is_on_sale',
				'value' => $model->is_on_sale == ShopProduct::IS_ON_SALE_UP ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],
			[
				'attribute' => 'is_delete',
				'value' => $model->is_delete == ShopProduct::IS_DELETE_YES ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],
			[
				'attribute' => 'is_hot',
				'value' => $model->is_hot == ShopProduct::IS_HOT_YES ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],
			[
				'attribute' => 'is_promote',
				'value' => $model->is_promote == ShopProduct::IS_PROMOTE_YES ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],
			[
				'attribute' => 'is_check',
				'value' => $model->is_check == ShopProduct::IS_CHECK_YES ? Yii::t('common', 'Yes') : Yii::t('common', 'Not'),
			],
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(ShopProduct::getStatus(), $model->status),
			]
		],
	]) ?>

</div>
