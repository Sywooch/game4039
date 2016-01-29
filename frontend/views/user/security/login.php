<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">用户登陆</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/site/index') ?>">首页</a></li>
			<li class="active">登陆</li>
		</ul>
	</div>
	<!--/container-->
</div>
<?php $this->endBlock(); ?>
<div class="container content">
	<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

	<div class="row">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<?php $form = \kartik\widgets\ActiveForm::begin([
				'id' => 'login-form',
				'enableAjaxValidation' => true,
				'enableClientValidation' => false,
				'validateOnBlur' => false,
				'validateOnType' => false,
				'validateOnChange' => false,
				'options' => [
					'class' => 'reg-page'
				],
			]) ?>

			<div class="reg-header">
				<h2>用户登陆</h2>
			</div>

			<?= $form->field($model, 'login', [
				'addon' => [
					'prepend' => [
						'content' => '<i class="fa fa-user"></i>'
					],
				],
				'template' => "{input}",
				'inputOptions' => [
					'autofocus' => 'autofocus',
					'class' => 'form-control',
					'tabindex' => '1',
					'placeholder' => '用户名或者邮箱',
				],
			]) ?>

			<?= $form->field($model, 'password', [
				'addon' => [
					'prepend' => [
						'content' => '<i class="fa fa-lock"></i>'
					],
				],
				'template' => "{input}",
				'inputOptions' => [
					'autofocus' => 'autofocus',
					'class' => 'form-control',
					'tabindex' => '2',
					'placeholder' => '密码',
				],
			])->passwordInput() ?>

			<div class="row">
				<div class="col-md-6">
					<?php
					echo $form->field($model, 'rememberMe', [
						'template' => '{input}{label}',
						'labelOptions' => ['class' => 'cbx-label']
					])->widget(\kartik\checkbox\CheckboxX::classname(), ['autoLabel' => false]);
					?>
				</div>
				<div class="col-md-6">
					<?= Html::submitButton(Yii::t('user', 'Sign in'), ['class' => 'btn-u pull-right', 'tabindex' => '3']) ?>
				</div>
			</div>
			<?= $form->errorSummary($model) ?>

			<hr>
			<h4>忘记密码?</h4>

			<p>
				不用担心,<?= $module->enablePasswordRecovery ? Html::a('点击我', ['/user/recovery/request'], ['tabindex' => '5']) : '' ?>
				重置密码.</p>

			<?php if ($module->enableConfirmation): ?>
				<p><?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?></p>
			<?php endif ?>

			<?php if ($module->enableRegistration): ?>
				<p>
					<?= Html::a('没有账号? 注册!', ['/user/registration/register']) ?>
				</p>
			<?php endif ?>
			<hr>
			<?php \kartik\widgets\ActiveForm::end(); ?>

		</div>

	</div>
	<!--/row-->
</div>

