<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\KefuFaq;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\KefuFaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Kefu Faq');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-faq-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Kefu Faq'),
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
				'attribute' => 'category_id',
				'value' => function ($model)
				{
					return $model->category ? $model->category->title : null;
				},
				'filter' => ArrayHelper::map(\common\models\KefuFaqCat::find()->all(), 'id', 'title'),
			],
			'description',
			//'content:ntext',
			// 'created_at',
			// 'updated_at',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => KefuFaq::getStatus(),
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
