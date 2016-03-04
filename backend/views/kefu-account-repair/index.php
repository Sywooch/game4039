<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use common\models\KefuAccountRepair;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\KefuAccountRepairSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Kefu Account Repair');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-account-repair-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php if (Yii::$app->user->can('administrator')): ?>
		<p>
			<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
				'modelClass' => Yii::t('common', 'Kefu Account Repair'),
			]), ['create'], ['class' => 'btn btn-success']) ?>
		</p>
	<?php endif; ?>


	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'sn',
			[
				'attribute' => 'account',
				'value' => function ($model)
				{
					return $model->user->username;
				}
			],
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'reason',
				'enum' => KefuAccountRepair::getReason(),
			],
			'register_time:datetime',
			// 'register_place',
			// 'recent_games',
			// 'question_desc:ntext',
			// 'bind_email:email',
			// 'security_question_one',
			// 'security_question_one_answer',
			// 'security_question_two',
			// 'security_question_two_answer',
			// 'applicant_name',
			// 'applicant_phone',
			// 'applicant_identity',
			// 'applicant_email:email',
			// 'identity_front_base_url:url',
			// 'identity_front_path',
			// 'identity_back_base_url:url',
			// 'identity_back_path',
			'created_at:datetime',
			// 'updated_at',
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'progress',
				'enum' => KefuAccountRepair::getProgress(),
			],
			[
				'class' => \common\grid\EnumColumn::className(),
				'attribute' => 'status',
				'enum' => KefuAccountRepair::getStatus(),
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
