<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\Game;

/* @var $this yii\web\View */
/* @var $model common\models\Game */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="game-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'title'), ['prompt' => '']) ?>
	<?= $form->field($model, 'name') ?>
	<?= $form->field($model, 'description') ?>
	<?= $form->field($model, 'short') ?>
	<?= $form->field($model, 'factory') ?>
	<?= $form->field($model, 'cname') ?>

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

	<?= $form->field($model, 'coin') ?>
	<?= $form->field($model, 'coin_rate') ?>

	<?= $form->field($model, 'game_web_url') ?>
	<?= $form->field($model, 'game_bbs_url') ?>

	<?= $form->field($model, 'api_secret') ?>
	<?= $form->field($model, 'api_server') ?>
	<?= $form->field($model, 'api_key') ?>
	<?= $form->field($model, 'api_play') ?>
	<?= $form->field($model, 'api_pay') ?>
	<?= $form->field($model, 'api_check') ?>
	<?= $form->field($model, 'api_order') ?>

	<?= $form->field($model, 'q') ?>
	<?= $form->field($model, 'attr')->dropDownList(Game::getAttr()) ?>
	<?= $form->field($model, 'status')->radioList(Game::getStatus()) ?>
	<?= $form->field($model, 'is_recommend')->checkbox() ?>

	<?= $form->field($model, 'sort') ?>

	<div class="form-group">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
