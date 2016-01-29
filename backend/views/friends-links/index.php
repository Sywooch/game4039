<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\FriendsLinks;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FriendsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Friends Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friends-links-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Friends Links'),
		]), ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'name',
			'url:url',
			[
				'attribute' => 'category',
				'value' => function ($model)
				{
					return ArrayHelper::getValue(FriendsLinks::getCategory(), $model->category);
				},
				'filter' => FriendsLinks::getCategory(),
			],
			//'description',
			// 'slug',
			// 'sort',
			'created_at:datetime',
			// 'updated_at',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => [
					Yii::t('common', 'Not Used'),
					Yii::t('common', 'In Use'),
				]
			],

			['class' => 'yii\grid\ActionColumn'],
		],
		'layout' => "{items}\n{summary}\n{pager}",
	]); ?>

</div>
