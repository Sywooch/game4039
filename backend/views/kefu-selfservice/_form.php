<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\KefuSelfservice;

/* @var $this yii\web\View */
/* @var $model common\models\KefuSelfservice */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="kefu-selfservice-form">

	<?php $form = \kartik\widgets\ActiveForm::begin([

	]); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'title')) ?>

	<?php echo $form->field($model, 'game_role')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'game_server')->dropDownList(ArrayHelper::map(\common\models\GameServer::find()->all(), 'id', 'server_name'), ['prompt' => Yii::t('common', '')]) ?>

	<?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'attachments')->widget(
		\trntv\filekit\widget\Upload::className(),
		[
			'url' => ['/file-storage/upload'],
			'sortable' => true,
			'maxFileSize' => 10000000, // 10 MiB
			'maxNumberOfFiles' => 5,
		]);
	?>

	<?php echo $form->field($model, 'content')->textarea(['rows' => 6]) ?>

	<?php echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\dektrium\user\models\User::find()->all(), 'id', 'username'), ['prompt' => '']) ?>

	<div class="result">
		<h4>请在下面填写你的处理结果,点解'确认'按钮提交</h4>
		<?php echo $form->field($model, 'result')->textarea(['rows' => 6]) ?>

		<?php echo $form->field($model, 'status')->dropDownList(KefuSelfservice::getStatus()) ?>
	</div>

	<div class="form-group">
		<?php echo Html::submitButton(Yii::t('common','Submit'), ['class' => 'btn btn-primary']) ?>
	</div>

	<?php \kartik\widgets\ActiveForm::end(); ?>

</div>
