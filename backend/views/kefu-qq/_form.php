<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\KefuQq */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="kefu-qq-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'qq')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\backend\models\User::find()->all(), 'id', 'username')) ?>

	<?php echo $form->field($model, 'status')->checkbox() ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
