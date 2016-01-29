<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/31
 * Time: 15:09
 * Desc:
 */
use yii\helpers\Url;

$this->title = '客服中心';
?>
<?= $this->render('_topSlider');?>
<div class="container content faq-page">
	<div class="row margin-bottom-40">
		<div class="col-md-4 col-sm-6">
			<div class="service-block service-block-sea service-or">
				<div class="service-bg"></div>
				<i class="icon-custom icon-color-light rounded-x fa fa-qq"></i>

				<h2 class="heading-md">官方QQ验证</h2>

				<p><a href="<?= Url::to(['/kefu/kefu-qq-validate'])?>">立即验证</a> | <a href="<?= Url::to(['/kefu/kefu-qq-validate'])?>">安全提示</a></p>
			</div>
		</div>
		<div class="col-md-4 col-sm-6">
			<div class="service-block service-block-red service-or">
				<div class="service-bg"></div>
				<i class="icon-custom icon-color-light rounded-x icon-line fa fa-cogs"></i>

				<a href="<?= Url::to(['/kefu/check-account'])?>"><h2 class="heading-md">账号修复</h2></a>

				<p>通过提交申诉表单修复自己的账号</p>
			</div>
		</div>
		<div class="col-md-4 col-sm-12">
			<div class="service-block service-block-blue service-or">
				<div class="service-bg"></div>
				<i class="icon-custom icon-color-light rounded-x icon-line fa  fa-circle-thin"></i>

				<h2 class="heading-md">自助服务</h2>

				<p>
					<?php foreach(\common\models\KefuSelfserviceCat::find()->all() as $selfservices):?>
						<a href="<?= Url::to(['/kefu/'.$selfservices->slug])?>"><?= $selfservices->title?></a> |
					<?php endforeach;?>
					<a href="<?= Url::to(['/kefu/selfservice-result'])?>">结果</a>
				</p>
			</div>
		</div>
	</div>

	<!-- FAQ Content -->
	<div class="row">
		<!-- Begin Tab v1 -->
		<div class="col-md-6">
			<div class="tab-v1">
				<ul class="nav nav-tabs margin-bottom-20">
					<li class="active"><a data-toggle="tab" href="#home">游戏问题</a></li>
					<li><a data-toggle="tab" href="#profile">充值问题</a></li>
					<li><a data-toggle="tab" href="#messages">其他问题</a></li>
				</ul>
				<div class="tab-content">
					<!-- Tab Content 1 -->
					<div id="home" class="tab-pane fade in active">
						<div id="accordion-v1" class="panel-group acc-v1">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="#collapse-One" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
											【琅琊榜】战魂技能不能拖到技能栏吗？
										</a>
									</h4>
								</div>
								<div class="panel-collapse collapse in" id="collapse-One">
									<div class="panel-body">
										答：战魂技能不能直接拖到技能栏，怒气满了释放时会自动进入技能栏
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="#collapse-Seven" data-parent="#accordion-v1" data-toggle="collapse" class="accordion-toggle">
											【花千骨】妖神技能怎么升级？
										</a>
									</h4>
								</div>
								<div class="panel-collapse collapse" id="collapse-Seven">
									<div class="panel-body">
										答： 点技能，妖神技能，对应页面有升级要求
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Tab Content 1 -->

					<!-- Tab Content 2 -->
					<div id="profile" class="tab-pane fade">
						<div id="accordion-v2" class="panel-group acc-v1">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="#collapse-v2-One" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
											【网银支付】为什么我充值时经常提示什么证书已过期？
										</a>
									</h4>
								</div>
								<div class="panel-collapse collapse in" id="collapse-v2-One">
									<div class="panel-body">
										答： 若是提示网页证书已过期或此网站安全证书有问题，则可以把计算机右下角的时间调整为自动与Internet时间同步，再重新打开浏览器操作。
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="#collapse-v2-Two" data-parent="#accordion-v2" data-toggle="collapse" class="accordion-toggle">
											【网银支付】怎么我银行卡支付，老是验证不了的？
										</a>
									</h4>
								</div>
								<div class="panel-collapse collapse" id="collapse-v2-Two">
									<div class="panel-body">
										答： 这可能是浏览器问题，建议更换浏览器后再尝试，建议使用搜狗浏览器，若还一直提示验证不了，那需要联系银联客服检测银行卡情况了。
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Tab Content 2 -->

					<!-- Tab Content 3 -->
					<div id="messages" class="tab-pane fade">
						<div id="accordion-v3" class="panel-group acc-v1">

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="#collapse-v3-Two" data-parent="#accordion-v3" data-toggle="collapse" class="accordion-toggle">
											请问如何做任务赚取积分？
										</a>
									</h4>
								</div>
								<div class="panel-collapse collapse" id="collapse-v3-Two">
									<div class="panel-body">
										答： 登陆账号后，点击用户中心选择我的账号点击赚取积分，跳转到任务列表完成任务领取即可。
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Tab Content 3 -->
				</div>
			</div>
		</div><!--/col-md-6-->
		<!--End Tab v1-->

		<!-- Popular Topics -->
		<div class="col-md-6">
			<div class="headline"><h2>其他相关</h2></div>
			<div class="row main-check margin-bottom-30">
				<div class="col-xs-6 md-margin-bottom-20">
					<ul class="list-unstyled check-style">
						<li><i class="fa fa-angle-right color-green"></i> <a href="#">未成年人家长监护工程</a></li>
						<li><i class="fa fa-angle-right color-green"></i> <a href="#">密码找回流程</a></li>
					</ul>
				</div>
				<div class="col-xs-6">
					<ul class="list-unstyled check-style">
						<li><i class="fa fa-angle-right color-green"></i> <a href="#">客服守则</a></li>
						<li><i class="fa fa-angle-right color-green"></i> <a href="#">免责申明</a></li>
					</ul>
				</div>
			</div>

			<hr>

			<div class="row">
				<div class="col-md-6">
					<div class="faq-add">
						<div class="top-part">
							<i class="icon-support"></i>
							<h3 class="new-title">
								<a href="javascript:void (0);">问题咨询</a>
							</h3>
						</div>
						<p><a href="">咨询客服</a></p>
						<p>
							用心创造服务！极致的专业体验！
						</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="faq-add">
						<div class="top-part">
							<i class="icon-support"></i>
							<h3 class="new-title">
								<a href="javascript:void(0);">客服热线</a>
							</h3>
						</div>
						<p>
							400-001-4039<br/>
							8:00-24:00（免长途通话费）
						</p>
					</div>
				</div>
			</div>
		</div><!--/col-md-6-->
		<!-- End Popular Topics -->
</div>

