<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 21:22
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
				<div class="headline"><h3>基本申请资料</h3></div>
				<?php $form = ActiveForm::begin(); ?>

				<?php echo $form->field($model, 'register_time')->widget(
					\trntv\yii\datetime\DateTimeWidget::className(),
					[
						//'momentDatetimeFormat' => 'YYYY-MM-DD, HH:mm',
						'phpDatetimeFormat' => 'yyyy-MM-dd',
						'clientOptions' => [
							'locale' => 'zh-CN'
						]
					]
				) ?>


				<?= $form->field($model, 'register_place') ?>

				<?= $form->field($model, 'recent_games')->dropDownList(ArrayHelper::map(\common\models\GameServer::find()->all(), 'id', 'server_name'), ['prompt' => '请选择游戏']) ?>
				<?= $form->field($model, 'question_desc')->textarea() ?>
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
$('.ji-ben-zi-liao').addClass('active');

JS;
$this->registerJs($js);
?>
