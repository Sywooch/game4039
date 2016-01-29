<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use common\models\IndexSlide;

/* @var $this yii\web\View */
/* @var $model common\models\IndexSlide */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="index-slide-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'game_id')->dropDownList(ArrayHelper::map(\common\models\Game::find()->statusInUse()->all(), 'id', 'name')) ?>

	<?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'description')->textarea() ?>

	<?php echo $form->field($model, 'thumbnail')->widget(
		\trntv\filekit\widget\Upload::className(),
		[
			'url' => ['/file-storage/upload'],
			'maxFileSize' => 5000000, // 5 MiB
		]);
	?>

	<?php echo $form->field($model, 'sort')->textInput() ?>

	<?php echo $form->field($model, 'access_url')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'official_url')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'status')->dropDownList(IndexSlide::getStatus()) ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
