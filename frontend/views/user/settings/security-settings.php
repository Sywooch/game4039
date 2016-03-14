<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Profile;

$this->title = '账号安全';

?>
	<div class="container content">
		<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
		<!--frofile-->
		<div class="profile">
			<div class="row">
				<!--Left Sidebar-->
				<div class="col-md-3 md-margin-bottom-40 margin-bottom-40">
					<?= $this->render('../_userLeftSideBar'); ?>
				</div>
				<!--End Left Sidebar-->

				<!-- Profile Content -->
				<div class="col-md-9">
					<div class="profile-body margin-bottom-20">
						<div class="tab-v1">
							<ul class="nav nav-justified nav-tabs">
								<li class="active"><a data-toggle="tab" href="#accountTab"> 账号 / 密码修改</a></li>
								<li><a data-toggle="tab" href="#securityQuestions"> 密保问题</a></li>
								<li><a data-toggle="tab" href="#nameAuth">实名认证</a></li>
								<li><a data-toggle="tab" href="#notifications">其他</a></li>
							</ul>
							<div class="tab-content">
								<div id="accountTab" class="profile-edit tab-pane fade in active">

									<blockquote class="hero">
										<h4>设置你的账号(包括修改密码)</h4>

										<p>如果你修改邮箱之后未进入新邮箱确认,新的邮箱将不会生效,确认的方法是填写新的邮箱地址点击确认,
											新邮箱会收到一封验证邮件,点击邮件中的超链接完成验证.</p>
									</blockquote>
									<br>
									<?php $form = ActiveForm::begin([
										'id' => 'account-form',
										'action' => ['/user/settings/account'],
										'options' => ['class' => 'form-horizontal'],
										'fieldConfig' => [
											'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
											'labelOptions' => ['class' => 'col-lg-3 control-label'],
										],
										'enableAjaxValidation' => true,
										'enableClientValidation' => false,
									]); ?>

									<?php if (Yii::$app->user->identity->unconfirmed_email != null): ?>
										<?= $form->field($model->getModel('account'), 'email')->label("邮箱(<span style='color: red;'>未确认</span>)") ?>
									<?php else: ?>
										<?= $form->field($model->getModel('account'), 'email') ?>
									<?php endif; ?>


									<?= $form->field($model->getModel('account'), 'username')->textInput(['readonly' => 'readonly']) ?>

									<?= $form->field($model->getModel('account'), 'new_password')->passwordInput() ?>

									<hr/>

									<?= $form->field($model->getModel('account'), 'current_password')->passwordInput() ?>

									<div class="form-group">
										<div class="col-lg-offset-3 col-lg-9">
											<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn-u']) ?>
											<br>
										</div>
									</div>

									<?php ActiveForm::end(); ?>
								</div>
								<div id="securityQuestions" class="profile-edit tab-pane fade">
									<blockquote class="hero">
										<p>完善您的密保信息</p>
									</blockquote>
									<?php $form = ActiveForm::begin([
										'id' => 'profile-form',
										'action' => ['/user/settings/security-questions'],
										'options' => ['class' => 'form-horizontal'],
										'fieldConfig' => [
											'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
											'labelOptions' => ['class' => 'col-lg-3 control-label'],
										],
										'enableAjaxValidation' => true,
										'enableClientValidation' => false,
										'validateOnBlur' => false,
									]); ?>

									<?= $form->field($model->getModel('securityQuestions'), 'question_one')->dropDownList(ArrayHelper::map(\common\models\SecurityQuestions::find()->all(), 'id', 'question'), ['prompt' => '']) ?>
									<?= $form->field($model->getModel('securityQuestions'), 'question_one_answer') ?>

									<?= $form->field($model->getModel('securityQuestions'), 'question_two')->dropDownList(ArrayHelper::map(\common\models\SecurityQuestions::find()->all(), 'id', 'question'), ['prompt' => '']) ?>
									<?= $form->field($model->getModel('securityQuestions'), 'question_two_answer') ?>

									<div class="form-group">
										<div class="col-lg-offset-3 col-lg-9">
											<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn-u']) ?><br>
										</div>
									</div>
									<?php ActiveForm::end(); ?>

								</div>


								<div id="nameAuth" class="profile-edit tab-pane fade">
									<blockquote class="hero">
										<p>填写你的身份证跟姓名</p>
									</blockquote>

									<br>
									<?php $form = ActiveForm::begin([
										'id' => 'profile-form',
										'action' => ['/user/settings/name-auth'],
										'options' => ['class' => 'form-horizontal'],
										'fieldConfig' => [
											'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
											'labelOptions' => ['class' => 'col-lg-3 control-label'],
										],
										'enableAjaxValidation' => true,
										'enableClientValidation' => false,
										'validateOnBlur' => false,
									]); ?>
									<?php if (($model->getModel('nameAuth')->identity_num)): ?>
										<?= $form->field($model->getModel('nameAuth'), 'name')->textInput(['readonly' => 'readonly',]) ?>
										<?= $form->field($model->getModel('nameAuth'), 'identity_num')->textInput(['readonly' => 'readonly',]) ?>
									<?php else: ?>
										<?= $form->field($model->getModel('nameAuth'), 'name') ?>
										<?= $form->field($model->getModel('nameAuth'), 'identity_num') ?>
									<?php endif; ?>

									<div class="form-group">
										<div class="col-lg-offset-3 col-lg-9">
											<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn-u']) ?><br>
										</div>
									</div>
									<?php ActiveForm::end(); ?>

								</div>

								<div id="notifications" class="profile-edit tab-pane fade">
									<h2 class="heading-md">管理你的通知</h2>

									<p>设置下面的开关打或者禁用一些通知消息</p>
									<br>

									<form class="sky-form" id="sky-form3" action="#">
										<hr>
										<label class="toggle"><input type="checkbox" checked=""
																	 name="checkbox-toggle-1"><i
												class="no-rounded"></i>接收系统消息</label>
										<hr>
										<label class="toggle"><input type="checkbox" checked=""
																	 name="checkbox-toggle-1"><i
												class="no-rounded"></i>你的邮箱接收系统推送消息</label>
										<hr>
										<button class="btn-u" type="submit">保存</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- End Profile Content -->
				</div>
			</div>
			<!--/container-->
		</div>
		<!--end profile-->
	</div>


<?php
$js = <<<JS

//make user-nav active
$('.index-nav').removeClass('active');
$('.user-nav').addClass('active');

//make user-history sidebar nav active
$('.user-security-settings').addClass('active');

App.init();
//App.initCounter();
//App.initScrollBar();
//Datepicker.initDatepicker();

JS;
$this->registerJs($js);
