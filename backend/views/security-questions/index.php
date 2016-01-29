<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\SecurityQuestions;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SecurityQuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Security Questions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="security-questions-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Security Questions'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'question',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => SecurityQuestions::getStatus(),
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
