<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/31
 * Time: 15:09
 * Desc:
 */
use yii\helpers\Url;
use common\util\Buuug7Util;

$this->title = '客服中心';
?>
<?= $this->render('_topSlider'); ?>
	<div class="container content faq-page">
		<div class="row margin-bottom-40">
			<div class="col-md-4 col-sm-6">
				<div class="service-block service-block-sea service-or">
					<div class="service-bg"></div>
					<i class="icon-custom icon-color-light rounded-x fa fa-qq"></i>

					<h2 class="heading-md">官方QQ验证</h2>

					<p><a href="<?= Url::to(['/kefu/kefu-qq-validate']) ?>">立即验证</a> | <a
							href="<?= Url::to(['/kefu/kefu-qq-validate']) ?>">安全提示</a></p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6">
				<div class="service-block service-block-red service-or">
					<div class="service-bg"></div>
					<i class="icon-custom icon-color-light rounded-x icon-line fa fa-cogs"></i>

					<a href="<?= Url::to(['/kefu/check-account']) ?>"><h2 class="heading-md">账号修复</h2></a>

					<p>通过提交申诉表单修复自己的账号</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="service-block service-block-blue service-or">
					<div class="service-bg"></div>
					<i class="icon-custom icon-color-light rounded-x icon-line fa  fa-circle-thin"></i>

					<h2 class="heading-md">自助服务</h2>

					<p>
						<?php foreach (\common\models\KefuSelfserviceCat::find()->all() as $selfservices): ?>
							<a href="<?= Url::to(['/kefu/' . $selfservices->slug]) ?>"><?= $selfservices->title ?></a> |
						<?php endforeach; ?>
						<a href="<?= Url::to(['/kefu/selfservice-result']) ?>">结果</a>
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
						<!-- Tab Content 1 youXiWenTis-->
						<div id="home" class="tab-pane fade in active">
							<div id="accordion-v1" class="panel-group acc-v1">
								<?php foreach (Buuug7Util::getKefuFaqbyCategorySlug("you-xi-wen-ti", 100) as $k => $youXiWenTi): ?>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href=<?= "#" . $youXiWenTi->category->title . $k ?>  data-parent="#accordion-v1"
												   data-toggle="collapse"
												   class="accordion-toggle">
													<?= $youXiWenTi->title ?>
												</a>
											</h4>
										</div>
										<div class=<?php if ($k == 0)
										{
											echo "\"panel-collapse collapse in\"";
										} else
										{
											echo "\"panel-collapse collapse\"";
										} ?> id=<?= $youXiWenTi->category->title . $k ?>>
											<div class="panel-body">
												<?= $youXiWenTi->content ?>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<!-- End Tab Content 1 youXiWenTis -->

						<!-- Tab Content 2 chongZhiWenTis -->
						<div id="profile" class="tab-pane fade">
							<div id="accordion-v2" class="panel-group acc-v1">
								<?php foreach (Buuug7Util::getKefuFaqbyCategorySlug("chong-zhi-wen-ti", 100) as $k => $chongZhiWenTi): ?>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href=<?= "#" . $chongZhiWenTi->category->title . $k ?> data-parent="#accordion-v2"
												   data-toggle="collapse"
												   class="accordion-toggle">
													<?= $chongZhiWenTi->title ?>
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse"
											 id=<?= $chongZhiWenTi->category->title . $k ?>>
											<div class="panel-body">
												<?= $chongZhiWenTi->content ?>
											</div>
										</div>
									</div>
								<?php endforeach; ?>

							</div>
						</div>
						<!-- Tab Content 2 chongZhiWenTis -->

						<!-- Tab Content 3 qiTaWenTis-->
						<div id="messages" class="tab-pane fade">
							<div id="accordion-v3" class="panel-group acc-v1">

								<?php foreach (Buuug7Util::getKefuFaqbyCategorySlug("qi-ta-wen-ti", 100) as $k => $qiTaWenTi): ?>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a href=<?= "#" . $qiTaWenTi->category->title . $k ?> data-parent="#accordion-v2"
												   data-toggle="collapse"
												   class="accordion-toggle">
													<?= $qiTaWenTi->title ?>
												</a>
											</h4>
										</div>
										<div class="panel-collapse collapse" id=<?= $qiTaWenTi->category->title . $k ?>>
											<div class="panel-body">
												<?= $qiTaWenTi->content ?>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<!-- Tab Content 3 qiTaWenTis-->
					</div>
				</div>
			</div>
			<!--/col-md-6-->
			<!--End Tab v1-->

			<!-- Popular Topics -->
			<div class="col-md-6">
				<div class="headline"><h2>其他相关</h2></div>
				<div class="row main-check margin-bottom-30">
					<div class="col-xs-6 md-margin-bottom-20">
						<ul class="list-unstyled check-style">
							<li><i class="fa fa-angle-right color-green"></i> <a
									href=<?= Url::to(['/page/jia-zhang-jian-hu-gong-cheng']) ?>>未成年人家长监护工程</a></li>
							<li><i class="fa fa-angle-right color-green"></i> <a href="#">密码找回流程</a></li>
						</ul>
					</div>
					<div class="col-xs-6">
						<ul class="list-unstyled check-style">
							<li><i class="fa fa-angle-right color-green"></i> <a href="#">客服守则</a></li>
							<li><i class="fa fa-angle-right color-green"></i> <a
									href=<?= Url::to(['/page/mian-ze-sheng-ming']) ?>>免责申明</a></li>
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
									<a href="javascript:void (0);">在线问题咨询</a>
								</h3>
							</div>
							<div class="online-qq">
								<a href="tencent://message/?uin=20654039&Site=game4039.com&Menu=yes"><i
										class="fa fa-qq"></i><span>在线QQ咨询</span></a>
							</div>

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
			</div>
			<!--/col-md-6-->
			<!-- End Popular Topics -->

		</div>
	</div>
	<div id="leftsead">
		<ul class="list-unstyled">
			<li>
				<a href="tencent://message/?uin=20654039&Site=game4039.com&Menu=yes">
					<img src="<?= Url::to(['/img/foot03/ll04.png']) ?>" width="131" height="49" class="hides"/>
					<img src="<?= Url::to(['/img/foot03/l04.png']) ?>" width="47" height="49" class="shows"/>
				</a>
			</li>
			<li>
				<a id="top_btn">
					<img src="<?= Url::to(['/img/foot03/ll06.png']) ?>" width="131" height="49" class="hides"/>
					<img src="<?= Url::to(['/img/foot03/l06.png']) ?>" width="47" height="49" class="shows"/>
				</a>
			</li>
		</ul>
	</div>
	<!--leftsead end-->

<?php
$css = <<<CSS
/* online-qq */
.online-qq{
	margin-top:10px;
	margin-bottom:10px;
	//background-color:red;
}
.online-qq span{
	margin-left:5px;
}
.online-qq a{
	font-size:16px;
	//color:red;
	text-decoration: none;
}


/* leftsead */
#leftsead{width:131px;height:143px;position:fixed;top:358px;right:0px;}
*html #leftsead{margin-top:258px;position:absolute;top:expression(eval(document.documentElement.scrollTop));}
#leftsead li{width:131px;height:60px;}
#leftsead li img{float:right;}
#leftsead li a{height:49px;float:right;display:block;min-width:47px;max-width:131px;}
#leftsead li a .shows{display:block;}
#leftsead li a .hides{margin-right:-143px;cursor:pointer;cursor:hand;}
#leftsead li a.youhui .hides{display:none;position:absolute;right:190px;top:2px;}
CSS;
$this->registerCss($css);

$js = <<<JS
$("#leftsead a").hover(function(){
		if($(this).prop("className")=="youhui"){
			$(this).children("img.hides").show();
		}else{
			$(this).children("img.hides").show();
			$(this).children("img.shows").hide();
			$(this).children("img.hides").animate({marginRight:'0px'},'slow');
		}
	},function(){
		if($(this).prop("className")=="youhui"){
			$(this).children("img.hides").hide('slow');
		}else{
			$(this).children("img.hides").animate({marginRight:'-143px'},'slow',function(){
				$(this).hide();
				$(this).next("img.shows").show();
			});
		}
	});

	$("#top_btn").click(function(){if(scroll=="off") return;$("html,body").animate({scrollTop: 0}, 600);});
JS;
$this->registerJs($js);




