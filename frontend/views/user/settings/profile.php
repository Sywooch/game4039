<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Profile;

$this->title = '账号设置';

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
								<li class="active"><a data-toggle="tab" href="#profile">个人资料</a></li>

								<li><a data-toggle="tab" href="#avata">头像</a></li>
								<li><a data-toggle="tab" href="#notifications">其他</a></li>
							</ul>
							<div class="tab-content">
								<div id="profile" class="profile-edit tab-pane fade in active">
									<h2 class="heading-md">设置您账号的一些基本信息.</h2>
									<?php $form = ActiveForm::begin([
										'id' => 'profile-form',
										'action' => ['/user/settings/profile'],
										'options' => ['class' => 'form-horizontal'],
										'fieldConfig' => [
											'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
											'labelOptions' => ['class' => 'col-lg-3 control-label'],
										],
										'enableAjaxValidation' => true,
										'enableClientValidation' => false,
										'validateOnBlur' => false,
									]); ?>

									<?= $form->field($model, 'nickname') ?>

									<?= $form->field($model, 'gender')->radioList(Profile::getGenderList()) ?>

									<?= $form->field($model, 'public_email') ?>

									<?= $form->field($model, 'location') ?>

									<?= $form->field($model, 'qq') ?>

									<?= $form->field($model, 'birthday')->widget(
										\trntv\yii\datetime\DateTimeWidget::className(),
										[
											'phpDatetimeFormat' => 'yyyy-MM-dd',
											'momentDatetimeFormat' => 'YYYY-MM-DD',
											'clientOptions' => [
												'locale' => 'zh-CN'
											]
										]
									) ?>

									<?= $form->field($model, 'bio')->textarea() ?>

									<div class="form-group">
										<div class="col-lg-offset-3 col-lg-9">
											<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn-u']) ?><br>
										</div>
									</div>
									<?php ActiveForm::end(); ?>
								</div>


								<div id="avata" class="profile-edit tab-pane fade">
									<h2 class="heading-md">设置你的头像</h2>

									<p>修改您的头像.</p>
									<br>
									<?= \common\util\UcenterUtil::ucAvatar(Yii::$app->user->identity) ?>
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
$('.user-settings').addClass('active');

 App.init();
//App.initCounter();
//App.initScrollBar();
//Datepicker.initDatepicker();
JS;
$this->registerJs($js);
