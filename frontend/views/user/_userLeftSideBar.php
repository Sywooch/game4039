<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/23
 * Time: 17:50
 * Desc:
 */
use yii\helpers\Url;

$this->title = "用户中心";

//用户vip
$dzUserLeftBar = (new \common\util\DzHelper())->getDzUserByUsername(Yii::$app->user->identity->username);
$creditLeftBar = (new \frontend\models\Credits())->getUserVipLevelByCredit($dzUserLeftBar['credits']);

//用户账号完善度
$userAccountPerfect=(new \frontend\models\UserAccountPerfectDegree(YIi::$app->user->identity->getId()))->getUserAccountPerfectDegree();
?>

<!--user left avatar-->
<div style="border: 1px solid #ddd;">
	<img class="img-responsive profile-img margin-bottom-20 img-circle center-block"
		 src="<?= \common\util\UcenterUtil::getUserAvatar(Yii::$app->user->identity) ?>" alt="">
</div>

<!--end user left avatar-->

<!--user left nav-->
<ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
	<li class="list-group-item user-info">
		<a href="<?= Url::to(['/user/profile/index']) ?>"><i class="fa fa-user"></i> 个人信息</a>
	</li>
	<li class="list-group-item user-history">
		<a href="<?= Url::to(['/user/profile/user-history']) ?>"><i class="fa fa-gamepad"></i> 我的游戏</a>
	</li>
	<li class="list-group-item user-credits">
		<a href="<?= Url::to(['/user/profile/credits']) ?>"><i class="fa fa-database"></i> 我的积分</a>
	</li>
	<li class="list-group-item user-message">
		<a href="<?= Url::to(['/user/profile/user-message']) ?>"><i class="fa fa-envelope"></i> 我的消息</a>
	</li>
	<li class="list-group-item">
		<a href="<?= Url::to(['/product/my-order']) ?>"><i class="fa fa-shopping-cart"></i> 我的订单</a>
	</li>
	<li class="list-group-item user-security-settings">
		<a href="<?= Url::to(['/user/settings/security-settings']) ?>"><i class="fa fa-lock"></i> 账号安全</a>
	</li>
	<li class="list-group-item user-settings">
		<a href="<?= Url::to(['/user/settings/index']) ?>"><i class="fa fa-cog"></i> 设置</a>
	</li>
</ul>
<!--end user left nav-->

<!--user left progress-->
<div class="panel-heading-v2 overflow-h">
	<h2 class="heading-xs pull-left"><i class="fa fa-bar-chart-o"></i> 进度条</h2>
	<a href="#"><i class="fa fa-cog pull-right"></i></a>
</div>
<h3 class="heading-xs">
	<a href="<?= Url::to(['/user/profile/credits']) ?>" style="text-decoration: none;">Vip经验</a>
	<span class="pull-right" style="font-size: 12px;"><?= $creditLeftBar['next-level-info'] ?></span>
</h3>

<div class="progress progress-u progress-xxs">
	<div style="width: <?= $creditLeftBar['current-percent'] ?>%" aria-valuemax="100" aria-valuemin="0"
		 aria-valuenow="<?= $creditLeftBar['current-percent'] ?>" role="progressbar"
		 class="progress-bar progress-bar-u">
	</div>
</div>
<h3 class="heading-xs">
	<a href="<?= Url::to(['/user/settings/profile']) ?>" style="text-decoration:none">账号完整度</a>
	<span class="pull-right"><?= $userAccountPerfect?>%</span>
</h3>

<div class="progress progress-u progress-xxs">
	<div style="width: <?= $userAccountPerfect?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?= $userAccountPerfect?>" role="progressbar"
		 class="progress-bar progress-bar-blue">
	</div>
</div>
<!--end user left progress-->
<hr>

<!--Notification-->
<!--End Notification-->

<!--datepicker-->
<!--<form action="#" id="sky-form2" class="sky-form">
	<div id="inline-start"></div>
</form>-->
<!--end datapicker-->
<div class="margin-bottom-50"></div>
