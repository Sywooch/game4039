<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 21:09
 * Desc:
 */
use yii\helpers\Url;
use yii\helpers\Html;
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
				<div class="headline"><h3>选择申诉原因</h3></div>
				<?php $form = ActiveForm::begin(); ?>
				<?= $form->field($model, 'reason')->dropDownList(\common\models\KefuAccountRepair::getReason())?>
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
jQuery(document).ready(function() {

$('.xuan-ze-reason').addClass('active');

    });
JS;
$this->registerJs($js);
?>
