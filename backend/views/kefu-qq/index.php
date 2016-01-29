<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\KefuQq;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\KefuQqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Kefu QQ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-qq-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => Yii::t('common', 'Kefu QQ'),
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'qq',
			//'user_id',
			'user_name',
			'created_at:datetime',
			// 'updated_at',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => KefuQq::getStatus(),
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
