<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ShopOrder */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="shop-order-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'address')->textarea(['rows' => 3]) ?>

	<?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'notes')->textarea(['rows' => 3]) ?>

	<?php echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\frontend\models\User::find()->all(), 'id', 'username'), ['prompt' => '']) ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
