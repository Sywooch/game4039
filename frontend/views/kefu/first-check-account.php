<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 17:53
 * Desc:
 */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>
<?= $this->render('_topSlider'); ?>

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
		<?php
		use kartik\alert\AlertBlock;

		echo AlertBlock::widget([
			'type' => AlertBlock::TYPE_ALERT,
			'useSessionFlash' => true,
			'delay' => false,
		]);
		?>
		<div class="row">
			<div class="col-md-12">
				<?= $this->render('_menu_account_repair'); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="tag-box tag-box-v3">
					<div class="headline"><h3>验证申请账号</h3></div>
					<?php $form = ActiveForm::begin([
						'options' => [
							'class' => 'form-horizontal',
						],
					]); ?>

					<?= $form->field($model, 'account',
						[
							'template' => "<label class='col-sm-2 col-xs-2 control-label'>账号:</label>\n<div class='col-sm-6 col-xs-6'>{input}\n{hint}\n{error}</div>"
						]
					)->textInput(['placeholder' => '请输入你要修复的账号']) ?>

					<div class="form-group">
						<div class="col-sm-offset-2 col-xs-offset-2 col-sm-8 col-xs-8">
							<?= Html::submitButton('下一步', ['class' => 'btn btn-primary']) ?>
						</div>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>

<?php

$js = <<<JS
$('.yan-zheng-account').addClass('active');

JS;
$this->registerJs($js);
?>