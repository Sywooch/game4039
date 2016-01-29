<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ActivityCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Activity Category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-category-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Activity Category'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'parent_id',
			'title',
			'slug',

			['class' => 'yii\grid\ActionColumn'],
		],
		'layout' => "{items}\n{summary}\n{pager}",
	]); ?>

</div>
