<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\KefuAccountRepair;

/* @var $this yii\web\View */
/* @var $model common\models\KefuAccountRepair */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="kefu-account-repair-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'account')->dropDownList(ArrayHelper::map(\dektrium\user\models\User::find()->all(), 'id', 'username'), ['prompt' => '']) ?>

	<?php echo $form->field($model, 'reason')->dropDownList(KefuAccountRepair::getReason()) ?>

	<?php echo $form->field($model, 'register_time')->widget(
		\trntv\yii\datetime\DateTimeWidget::className(),
		[
			//'momentDatetimeFormat' => 'YYYY-MM-DD, HH:mm',
			'phpDatetimeFormat' => 'yyyy-MM-dd',
			'clientOptions' => [
				'locale' => 'zh-CN'
			]
		]
	) ?>

	<?php echo $form->field($model, 'register_place')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'recent_games')->dropDownList(ArrayHelper::map(\common\models\Game::find()->all(), 'id', 'name'), ['prompt' => '']) ?>

	<?php echo $form->field($model, 'question_desc')->textarea(['rows' => 6]) ?>

	<?php echo $form->field($model, 'bind_email')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'security_question_one')->dropDownList(ArrayHelper::map(\common\models\SecurityQuestions::find()->all(), 'id', 'question'), ['prompt' => '']) ?>

	<?php echo $form->field($model, 'security_question_one_answer')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'security_question_two')->dropDownList(ArrayHelper::map(\common\models\SecurityQuestions::find()->all(), 'id', 'question'), ['prompt' => '']) ?>

	<?php echo $form->field($model, 'security_question_two_answer')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'applicant_name')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'applicant_phone')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'applicant_identity')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'applicant_email')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'identity_front')->widget(
		\trntv\filekit\widget\Upload::className(),
		[
			'url' => ['/file-storage/upload'],
			'maxFileSize' => 5000000, // 5 MiB
		]);
	?>

	<?php echo $form->field($model, 'identity_back')->widget(
		\trntv\filekit\widget\Upload::className(),
		[
			'url' => ['/file-storage/upload'],
			'maxFileSize' => 5000000, // 5 MiB
		]);
	?>

	<?php echo $form->field($model, 'progress')->dropDownList(KefuAccountRepair::getProgress()) ?>

	<?php echo $form->field($model, 'status')->checkbox()->label(Yii::t('common', 'Active')) ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
