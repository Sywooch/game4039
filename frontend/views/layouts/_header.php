<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/21
 * Time: 16:58
 * Desc:
 */
use common\util\Buuug7Util;
use yii\helpers\Url;

?>


<div class="header-v8 header-sticky">
	<!-- Topbar blog -->
	<?php include_once('_topbar.php')?>
	<!-- End Topbar blog -->

	<!-- Navbar -->
	<div class="navbar mega-menu" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="res-container">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target=".navbar-responsive-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div class="navbar-brand">
					<a class="logo" href="<?= Url::to('site/index') ?>">
						<img src="<?= Url::to('@web/img/logo_4039_black.png') ?>" alt="Logo">
					</a>
				</div>
			</div>
			<!--/end responsive container-->

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-responsive-collapse">
				<div class="res-container">
					<ul class="nav navbar-nav">
						<!-- 首页 -->
						<li class="dropdown active index-nav">
							<a href="<?= Url::to(['site/index']) ?>" class="dropdown-toggle" data-toggle="">
								首页
							</a>
						</li>
						<!-- End 首页 -->

						<!-- 游戏大厅 -->
						<li class="dropdown mega-menu-fullwidth game-nav">
							<a href="<?= Url::to(['game/index'])?>" class="dropdown-toggle" data-toggle="">
								游戏大厅
							</a>
						</li>
						<!-- End 游戏大厅 -->

						<!-- 资讯 -->
						<li class="dropdown home  zixun-nav">
							<a href="<?= Url::to(['article/index']) ?>" class="dropdown-toggle" data-toggle="">
								资讯
							</a>
						</li>
						<!-- End 资讯 -->

						<!-- 用户 -->
						<li class="dropdown  user-nav">
							<a href="<?= Url::to(['user/profile']) ?>" class="dropdown-toggle" data-toggle="">
								用户
							</a>
						</li>
						<!-- End 用户 -->

						<!-- 活动 -->
						<li class="dropdown  activity-nav">
							<a href="<?= Url::to(['activities/index']) ?>" class="dropdown-toggle" data-toggle="">
								活动
							</a>
						</li>
						<!-- End 活动 -->

						<!-- 商城 -->
						<li class="dropdown shangcheng-nav">
							<a href="<?=Url::to(['product/index'])?>" class="dropdown-toggle" data-toggle="">
								商城
							</a>
						</li>
						<!-- End 商城 -->

						<!-- 客服 -->
						<li class="dropdown kefu-nav">
							<a href="<?= Url::to(['kefu/index'])?>" class="dropdown-toggle" data-toggle="">
								客服
							</a>
						</li>
						<!-- End 客服 -->

						<!-- 充值 -->
						<li class="dropdown chongzhi-nav">
							<a href="<?= Url::to('zhi-fu/index')?>" class="dropdown-toggle" data-toggle="">
								充值
							</a>
						</li>
						<!-- End 充值 -->

						<!-- 论坛 -->
						<li class="dropdown">
							<a href="<?= Yii::getAlias('@bbsUrl') ?>" class="dropdown-toggle" data-toggle=""
							   target="_blank">
								论坛
							</a>
						</li>
						<!-- End 论坛 -->

					</ul>
				</div>
				<!--/responsive container-->
			</div>
			<!--/navbar-collapse-->
		</div>
		<!--/end contaoner-->
	</div>
	<!-- End Navbar -->
</div>
