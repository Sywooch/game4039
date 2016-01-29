<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KefuSelfserviceCat */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="kefu-selfservice-cat-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map($categories, 'id', 'title'), ['prompt' => Yii::t('common', 'Root')]) ?>

	<?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
