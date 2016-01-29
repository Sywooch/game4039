<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\GameServer;
use trntv\yii\datetime\DateTimeWidget;

/* @var $this yii\web\View */
/* @var $model common\models\GameServer */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="game-server-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'server_id')->textInput() ?>

	<?php echo $form->field($model, 'server_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'game_id')->dropDownList(\yii\helpers\ArrayHelper::map($games, 'id', 'name'), ['prompt' => '']) ?>

	<?php echo $form->field($model, 'server_key')->textInput(['maxlength' => true]) ?>


	<?php echo $form->field($model, 'start_time')->widget(
		DateTimeWidget::className(),
		[
			'phpDatetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
			'momentDatetimeFormat' => 'YYYY-MM-DD HH:mm',
			'clientOptions' => [
				'locale' => 'zh-CN'
			]
		]
	) ?>

	<?php echo $form->field($model, 'is_new')->checkbox() ?>

	<?php echo $form->field($model, 'is_hot')->checkbox() ?>

	<?php echo $form->field($model, 'is_recommend')->checkbox() ?>

	<?php echo $form->field($model, 'is_shutdown')->checkbox() ?>

	<?php echo $form->field($model, 'status')->dropDownList(GameServer::getStatus()) ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
