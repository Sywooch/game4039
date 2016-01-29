<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\KefuAccountRepair;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\KefuAccountRepair */

$this->title = $model->sn;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Account Repair'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-account-repair-view">

	<p>
		<?php echo Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
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
			'sn',
			[
				'attribute' => 'account',
				'value' => $model->user->username,
			],
			[
				'attribute' => 'reason',
				'value' => ArrayHelper::getValue(KefuAccountRepair::getReason(), $model->reason),
			],
			'register_time:datetime',
			'register_place',
			[
				'attribute' => 'recent_games',
				'value' => $model->recentGames->name,
			],
			'question_desc:ntext',
			'bind_email:email',
			[
				'attribute' => 'security_question_one',
				'value' => $model->securityQuestionOne ? $model->securityQuestionOne->question : null,
			],
			'security_question_one_answer',
			[
				'attribute' => 'security_question_two',
				'value' => $model->securityQuestionTwo ? $model->securityQuestionTwo->question : null,
			],
			'security_question_two_answer',
			'applicant_name',
			'applicant_phone',
			'applicant_identity',
			'applicant_email:email',
			//'identity_front_base_url:url',
			//'identity_front_path',
			[
				'attribute' => 'identity_front',
				'format' => 'html',
				'value' => Html::img(Yii::$app->glide->createSignedUrl([
					'glide/index',
					'path' => $model->identity_front_path,
					'w' => 200,
				], true), ['class' => 'img-responsive'])
			],
			//'identity_back_base_url:url',
			//'identity_back_path',
			[
				'attribute' => 'identity_front',
				'format' => 'html',
				'value' => Html::img(Yii::$app->glide->createSignedUrl([
					'glide/index',
					'path' => $model->identity_back_path,
					'w' => 200,
				], true), ['class' => 'img-responsive'])
			],
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'progress',
				'value' => ArrayHelper::getValue(KefuAccountRepair::getProgress(), $model->progress),
			],
			[
				'attribute' => 'status',
				'value' => ArrayHelper::getValue(KefuAccountRepair::getStatus(), $model->status),
			],
		],
	]) ?>

</div>
