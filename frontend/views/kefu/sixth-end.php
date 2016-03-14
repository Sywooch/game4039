<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 21:44
 * Desc:
 */


use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
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
					<div class="headline"><h3>结果</h3></div>
					<div class="row to-top">
						<div class="col-lg-12">
							<h3 style="text-align: center;"><?= $this->title ?></h3>
						</div>
					</div>

					<div class="row to-top">
						<div class="col-lg-12 col-lg-offset-1">
							<div>
								<p>您的资料已提交成功，我们会尽快处理，请您耐心等待！</p>

								<p>本次服务的编号为：<span style="color: red;"><?= $model->sn ?></span>，此项信息也发送至您的邮箱。</p>

								<p>请您妥善保管，服务编号、查询密码为查询结果的凭证，遗失无法找回！</p>

								<p>此信息也发送到您提供的电子邮箱里,请点击查看<span style="color: red;"><?= $model->applicant_email ?></span>
								</p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php

$js = <<<JS
$('.jie-shu').addClass('active');

JS;
$this->registerJs($js);
?>