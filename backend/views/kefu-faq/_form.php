<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\KefuFaq;

/* @var $this yii\web\View */
/* @var $model common\models\KefuFaq */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="kefu-faq-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map($categories, 'id', 'title'), ['prompt' => Yii::t('common', '')]) ?>

	<?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'content')->textarea(['rows' => 6]) ?>

	<?php echo $form->field($model, 'status')->radioList(KefuFaq::getStatus()) ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
