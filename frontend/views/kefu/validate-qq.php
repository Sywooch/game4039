<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 15:22
 * Desc:
 */
use yii\helpers\Url;

$this->title = '官方QQ验证';
?>
<?= $this->render('_topSlider');?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">客服中心</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/kefu/index') ?>">客服中心</a></li>
			<li class="active">官方QQ验证</li>
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
			<div class="panel panel-grey margin-bottom-40">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-tasks"></i> 官方QQ验证</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form2" style="padding: 80px 30px;">
								<?php $form = \kartik\form\ActiveForm::begin([
									'id' => $model->formName(),
									'type' => \kartik\form\ActiveForm::TYPE_INLINE,
									'formConfig' => [
										'showErrors' => true,
									]
								]) ?>
								<?= $form->field($model, 'qq', [
									'addon' => [
										'prepend' => ['content' => '<i class="fa fa-qq"></i>'],
										'append' => ['content' => '<button class="btn-u btn-u-default">Go</button>', 'asButton' => true]
									]
								]) ?>
								<?php \kartik\form\ActiveForm::end(); ?>
							</div>
						</div>
						<div class="col-md-6">

							<blockquote class="hero">
								<h4>安全提示</h4>
								<ul>
									<li>请您不要相信游戏中发布的虚假中奖信息，一切活动信息均以官网上的信息为准；</li>
									<li>请您不要向任何人透露您的游戏帐号和密码，如果由此带来的一切损失，我们是无法帮玩家进行处理，需要由玩家自己承担；</li>
									<li>4039游戏平台从未向任何第三方授权进行游戏币交易；</li>
									<li>帐号注册、密码找回、被盗找回等注意事项，请查看官网的客服中心；</li>
								</ul>
							</blockquote>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>