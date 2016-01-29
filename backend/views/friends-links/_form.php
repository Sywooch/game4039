<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\FriendsLinks;

/* @var $this yii\web\View */
/* @var $model common\models\FriendsLinks */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="friends-links-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'category')->dropDownList($model->getCategory(), ['prompt' => '']) ?>

	<?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?php echo $form->field($model, 'sort')->textInput(['value' => FriendsLinks::ORDER_DEFAULT]) ?>

	<?php echo $form->field($model, 'status')->dropDownList(FriendsLinks::getStatus()) ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
