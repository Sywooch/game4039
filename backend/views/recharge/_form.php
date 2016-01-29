<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Recharge;

/* @var $this yii\web\View */
/* @var $model common\models\Recharge */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="recharge-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\frontend\models\User::find()->all(), 'id', 'username'),['prompt' => '',]) ?>

	<?php echo $form->field($model, 'game_id')->dropDownList(ArrayHelper::map(\common\models\Game::find()->statusInUse()->all(),'id','name'),['prompt' => '',]) ?>

	<?php echo $form->field($model, 'server_id')->dropDownList(ArrayHelper::map(\common\models\GameServer::find()->statusInUse()->all(),'id','server_name'),['prompt' => '',]) ?>

	<?php echo $form->field($model, 'pay_mode')->dropDownList(Recharge::getPayMode(),['prompt' => '',]) ?>

	<?php echo $form->field($model, 'role_id')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'order_id')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'status')->textInput() ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
