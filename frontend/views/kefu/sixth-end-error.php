<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 21:46
 * Desc:
 */


use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

?>


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
								<?= Html::tag('h4', '非常抱歉,我们无法处理你提交的信息,请稍后重试!', ['class' => 'text-warning']) ?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php

$js = <<<JS
jQuery(document).ready(function() {
//make user-nav active
$('.index-nav').removeClass('active');
$('.kefu-nav').addClass('active');

$('.jie-shu').addClass('active');

    });
JS;
$this->registerJs($js);
?>