<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\Activity;
use trntv\yii\datetime\DateTimeWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="activity-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'title'), ['prompt' => '']) ?>

	<?= $form->field($model, 'relation_game_id')->dropDownList(ArrayHelper::map(\common\models\Game::find()->statusInUse()->all(),'id','name'),['prompt' => '',])?>

	<?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

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

	<?php echo $form->field($model, 'end_time')->widget(
		DateTimeWidget::className(),
		[
			'phpDatetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
			'momentDatetimeFormat' => 'YYYY-MM-DD HH:mm',
			'clientOptions' => [
				'locale' => 'zh-CN'
			]
		]
	) ?>

	<?php echo $form->field($model, 'thumbnail')->widget(
		\trntv\filekit\widget\Upload::className(),
		[
			'url' => ['/file-storage/upload'],
			'maxFileSize' => 5000000, // 5 MiB
		]);
	?>

	<?php echo $form->field($model, 'bg_image')->widget(
		\trntv\filekit\widget\Upload::className(),
		[
			'url' => ['/file-storage/upload'],
			'maxFileSize' => 5000000, // 5 MiB
		])->label('背景图片(1920X1288)');
	?>

	<?php echo $form->field($model, 'description')->textarea(['rows' => 4]) ?>

	<?php echo $form->field($model, 'guize')->widget(
		\yii\imperavi\Widget::className(),
		[
			'plugins' => ['fullscreen', 'fontcolor', 'video','fontsize'],
			'options' => [
				'lang' => 'zh',
				'minHeight' => 150,
				'maxHeight' => 400,
				'buttonSource' => true,
				'convertDivs' => false,
				'removeEmptyTags' => false,
				'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
			]
		]
	) ?>

	<?php echo $form->field($model, 'jiangli')->widget(
		\yii\imperavi\Widget::className(),
		[
			'plugins' => ['fullscreen', 'fontcolor', 'video','fontsize'],
			'options' => [
				'lang' => 'zh',
				'minHeight' => 150,
				'maxHeight' => 400,
				'buttonSource' => true,
				'convertDivs' => false,
				'removeEmptyTags' => false,
				'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
			]
		]
	) ?>

	<?php echo $form->field($model, 'jiangli_fangfa')->widget(
		\yii\imperavi\Widget::className(),
		[
			'plugins' => ['fullscreen', 'fontcolor', 'video','fontsize'],
			'options' => [
				'lang' => 'zh',
				'minHeight' => 150,
				'maxHeight' => 400,
				'buttonSource' => true,
				'convertDivs' => false,
				'removeEmptyTags' => false,
				'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
			]
		]
	) ?>

	<?php echo $form->field($model, 'content')->widget(
		\yii\imperavi\Widget::className(),
		[
			'plugins' => ['fullscreen', 'fontcolor', 'video','fontsize'],
			'options' => [
				'lang' => 'zh',
				'minHeight' => 600,
				'maxHeight' => 800,
				'buttonSource' => true,
				'convertDivs' => false,
				'removeEmptyTags' => false,
				'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
			]
		]
	) ?>

	<?php echo $form->field($model, 'sort') ?>

	<?php echo $form->field($model, 'status')->dropDownList(Activity::getStatus()) ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
