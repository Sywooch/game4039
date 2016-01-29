<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">用户注册</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/site/index') ?>">首页</a></li>
			<li class="active">注册</li>
		</ul>
	</div>
	<!--/container-->
</div>
<?php $this->endBlock(); ?>
<div class="container content">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

			<?php $form = ActiveForm::begin([
				'id'                     => 'registration-form',
				'enableAjaxValidation'   => true,
				'enableClientValidation' => false,
				'options' => [
					'class' => 'reg-page',
				],
			]); ?>
			<div class="reg-header">
				<h2>账号注册</h2>
				<p>如果已有账号? 点击<a href="<?=Url::to('/user/security/login')?>" class="color-green"> 登陆 </a>登入你的账号.</p>
			</div>

			<?= $form->field($model, 'email') ?>

			<?= $form->field($model, 'username') ?>

			<?php if ($module->enableGeneratingPassword == false): ?>
				<?= $form->field($model, 'password')->passwordInput() ?>
			<?php endif ?>

			<hr>

			<div class="row">
				<div class="col-lg-6 checkbox">
					<label>
						<input type="checkbox">
						我已经阅读 <a href="" class="color-green">注册须知</a>
					</label>
				</div>
				<div class="col-lg-6 text-right">
					<?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn-u']) ?>
				</div>
			</div>
			<hr>
			<p class="text-center">
				<?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
			</p>
			<?php ActiveForm::end(); ?>

		</div>
	</div>
</div>


