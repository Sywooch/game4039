<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

use common\models\ShopProduct;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ShopProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Shop Product');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-product-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Shop Product'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'title',
			[
				'attribute' => 'relation_game',
				'value' => function ($model)
				{
					return $model->relationGame ? $model->relationGame->name : null;
				}
			],
			//'slug',
			'description:ntext',
			[
				'attribute' => 'category_id',
				'value' => function ($model)
				{
					return $model->category ? $model->category->title : null;
				},
				'filter' => \yii\helpers\ArrayHelper::map(\common\models\ShopCategory::find()->all(), 'id', 'title'),
			],
			'price',
			// 'jifen',
			// 'content:ntext',
			// 'keywords',
			[
				'label' => Yii::t('common', 'Thumbnail'),
				'format' => 'html',
				'value' => function ($dataProvider)
				{
					return Html::img(Yii::$app->glide->createSignedUrl([
						'glide/index',
						'path' => $dataProvider->thumbnail_path,
						'w' => 100
					], true), ['class' => 'img-rounded pull-left img-responsive']);
				}

			],
			// 'thumbnail_base_url:url',
			// 'thumbnail_path',
			// 'img_base_url:url',
			// 'img_path',
			// 'product_number',
			// 'return_jifen',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'is_on_sale',
				'enum' => [
					Yii::t('common', 'Not'),
					Yii::t('common', 'Yes'),
				]
			],
			// 'is_delete',
			// 'is_hot',
			// 'is_promote',
			// 'is_check',
			// 'created_at',
			// 'updated_at',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => ShopProduct::getStatus(),
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
