<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'receive')->dropDownList(\common\models\Message::getReceive()) ?>

	<?php echo $form->field($model, 'content')->widget(
		\yii\imperavi\Widget::className(),
		[
			'plugins' => ['fullscreen', 'fontcolor', 'video','fontsize'],
			'options' => [
				'lang' => 'zh',
				'minHeight' => 400,
				'maxHeight' => 400,
				'buttonSource' => true,
				'convertDivs' => false,
				'removeEmptyTags' => false,
				'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
			]
		]
	) ?>

	<?= $form->field($model,'sender')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false)?>

    <?php echo $form->field($model, 'status')->dropDownList(\common\models\Message::getStatus()) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
