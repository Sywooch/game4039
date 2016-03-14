<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 21:28
 * Desc:
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
?>

<?= $this->render('_topSlider');?>

<?php $this->beginBlock('breadcrumbs'); ?>
	<div class="breadcrumbs">
		<div class="container">
			<h1 class="pull-left">客服中心</h1>
			<ul class="pull-right breadcrumb">
				<li><a href="<?= Url::to('/kefu/index') ?>">客服中心</a></li>
				<li class="active">账号修复</li>
			</ul>
		</div>
	</div>
<?php $this->endBlock(); ?>

	<div class="container content">
		<div class="row">
			<div class="col-md-12">
				<?= $this->render('_menu_account_repair');?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="tag-box tag-box-v3">
					<div class="headline"><h3>更多资料</h3></div>
					<?php
					$questions = \common\models\SecurityQuestions::find()->all();
					?>

					<?php $form = ActiveForm::begin(); ?>
					<?= $form->field($model, 'bind_email') ?>
					<?= $form->field($model, 'security_question_one')->dropDownList(\yii\helpers\ArrayHelper::map($questions, 'id', 'question'), ['prompt' => '请选择问题']) ?>
					<?= $form->field($model, 'security_question_one_answer') ?>
					<?= $form->field($model, 'security_question_two')->dropDownList(\yii\helpers\ArrayHelper::map($questions, 'id', 'question'), ['prompt' => '请选择问题']) ?>
					<?= $form->field($model, 'security_question_two_answer') ?>
					<div class="form-group">
						<?= Html::submitButton('下一步', ['class' => 'btn btn-primary']) ?>
					</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>

	</div>

<?php

$js = <<<JS
$('.more-info').addClass('active');

JS;
$this->registerJs($js);
?>