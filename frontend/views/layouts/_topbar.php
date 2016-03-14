<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/30
 * Time: 16:47
 * Desc:
 */
use yii\helpers\Url;

?>

<div class="header-v8 header-sticky">
	<!-- Topbar blog -->
	<div class="blog-topbar">
		<div class="topbar-search-block">
			<div class="container">
				<form action="">
					<input type="text" class="form-control" placeholder="Search">

					<div class="search-close"><i class="icon-close"></i></div>
				</form>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-xs-8">
					<div class="topbar-time"><?= Yii::$app->formatter->asDatetime(time()) ?></div>
					<div class="topbar-toggler"><span class="fa fa-angle-down"></span></div>
					<ul class="topbar-list topbar-menu">
						<li><a href="<?= Url::to(['page/mian-ze-sheng-ming']) ?>">免责声明</a></li>
						<li><a href="<?= Url::to(['site/contact']) ?>">联系我们</a></li>
						<li><a href="<?= Url::to(['site/index']) ?>">首页</a></li>
						<li><a href="<?= Yii::getAlias('@bbsUrl') ?>" target="_blank">论坛</a></li>
						<?php if (!Yii::$app->user->isGuest): ?>
							<?php if (Yii::$app->user->identity->username === 'buuug7'): ?>
								<li><a href="<?= Url::to(['user/admin']) ?>" target="_blank" style="color:red;">用户管理</a></li>
							<?php endif; ?>
						<?php endif; ?>
						<?php if (Yii::$app->user->isGuest): ?>
							<li class="cd-log_reg hidden-sm hidden-md hidden-lg"><strong><a class="cd-signin"
																							href="<?= Url::to(['user/security/login']) ?>">登陆</a></strong>
							</li>
							<li class="cd-log_reg hidden-sm hidden-md hidden-lg"><strong><a class="cd-signup"
																							href="<?= Url::to(['user/register']) ?>">注册</a></strong>
							</li>
						<?php else: ?>
							<li class="cd-log_reg hidden-sm hidden-md hidden-lg"><strong><a class="cd-signin"
																							href="<?= Url::to(['user/profile']) ?>"><?= Yii::$app->user->identity->username ?></a></strong>
							</li>

							<li class="cd-log_reg hidden-sm hidden-md hidden-lg"><strong><a class="cd-signin"
																							href="<?= Url::to(['user/security/logout ']) ?>">退出</a></strong>
							</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="col-sm-4 col-xs-4 clearfix">
					<i class="fa fa-search search-btn pull-right"></i>
					<ul class="topbar-list topbar-log_reg pull-right visible-sm-block visible-md-block visible-lg-block">

						<?php if (Yii::$app->user->isGuest): ?>
							<li class="cd-log_reg home"><a class="cd-signin"
														   href="<?= Url::to(['user/security/login']) ?>">登陆</a></li>
							<li class="cd-log_reg"><a class="cd-signup" href="<?= Url::to(['user/register']) ?>">注册</a>
							</li>
						<?php else: ?>
							<li class="cd-log_reg home"><a class="cd-signin"
														   href="<?= Url::to(['user/profile']) ?>"><?= Yii::$app->user->identity->username ?></a>
							</li>
							<li class="cd-log_reg"><a class="cd-signup" href="<?= Url::to(['user/security/logout ']) ?>">退出</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			<!--/end row-->
		</div>
		<!--/end container-->
	</div>
	<!-- End Topbar blog -->

</div>