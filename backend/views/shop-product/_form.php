<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\ShopProduct;

/* @var $this yii\web\View */
/* @var $model common\models\ShopProduct */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="shop-product-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'relation_game')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Game::find()->all(), 'id', 'name'), ['prompt' => '']) ?>

	<?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map($categories, 'id', 'title'), ['prompt' => '']) ?>

	<?php echo $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'jifen')->textInput() ?>

	<?php echo $form->field($model, 'content')->widget(
		\yii\imperavi\Widget::className(),
		[
			'plugins' => ['fullscreen', 'fontcolor', 'video'],
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

	<?php echo $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'thumbnail')->widget(
		\trntv\filekit\widget\Upload::className(),
		[
			'url' => ['/file-storage/upload'],
			'maxFileSize' => 5000000, // 5 MiB
		]);
	?>
	<?php echo $form->field($model, 'img')->widget(
		\trntv\filekit\widget\Upload::className(),
		[
			'url' => ['/file-storage/upload'],
			'maxFileSize' => 5000000, // 5 MiB
		]);
	?>

	<?php echo $form->field($model, 'product_number')->textInput() ?>

	<?php echo $form->field($model, 'return_jifen')->textInput() ?>

	<?php echo $form->field($model, 'is_on_sale')->checkbox() ?>

	<?php echo $form->field($model, 'is_delete')->checkbox() ?>

	<?php echo $form->field($model, 'is_hot')->checkbox() ?>

	<?php echo $form->field($model, 'is_promote')->checkbox() ?>

	<?php echo $form->field($model, 'is_check')->checkbox() ?>

	<?php echo $form->field($model, 'status')->dropDownList(ShopProduct::getStatus()) ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
