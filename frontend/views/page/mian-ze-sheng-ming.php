<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/2/2
 * Time: 13:59
 * Desc:家长监护
 */

$this->title = '免责声明';
?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs breadcrumbs-dark">
	<div class="container">
		<h1 class="pull-left"><?= $this->title ?></h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= \yii\helpers\Url::to('/site/index')?>">首页</a></li>
			<li class="active"><?= $this->title ?></li>
		</ul>
	</div>
</div>
</div>
<?php $this->endBlock(); ?>

<div class="container content-sm">
	<div class="headline-center margin-bottom-60">
		<h2><?= $model->title ?></h2>
	</div>
	<div class="jia-zhang-jian-hu-gong-cheng">
		<p class="lead">
			&nbsp;&nbsp;&nbsp;&nbsp;
			www.4039.com (下面简称4039游戏)只为用户提供本责任条款内声明的管理服务项目，
			并保留在非正常情况下有可能导致网站部分功能暂时中断的临时调整处理权，
			例如网络或服务器故障、计算机程式错误、外来非法程序入侵、自然灾害、相关国家法律政策变动等，
			并对此类情况所造成的任何用户帐号资料损失不承担赔偿责任，用户游戏帐号资料将在游家游戏数据安全机制范围内受到尽可能完善的保护和备份，
			用户无权单方面要求帐号资料恢复到某状态
		</p>
		<p class="">
			4039游戏提供相关游戏平台给予用户游戏交流空间，用户对自己以游戏帐号在游戏内发生的所有言行负责，
			任何违反本责任条款、国家相关法律的行为或发生其他不正当行为都是严格禁止的，
			游家游戏对此类行为不承担任何责任，并保有权提交用户不正当行为证据给相关部门进行处理。
		</p>
		<p class="">
			任何用户都无权使用任何可能影响到游戏程序运行稳定或游戏发展的其他外部软件或手段来进行游戏，用户不得进行任何使服务器负载过量或造成技术超载的行为。
		</p>
		<p class="">
			4039游戏拥有网站所属游戏内容的所有管理运行权和知识产权，任何用户未经许可不得擅自阻断、重制、改动或其他任何形式复制游家游戏的网页及游戏内容。
		</p>
		<p class="">
			未经授权，严禁使用任何自制程序或网络工具登陆游戏帐号或在游戏进行中启动使用。尤其禁止任何可以自动运行、模拟、取代或补充游戏功能接口的外来程序工具。
		</p>
		<p class="">
			严禁用户利用游戏帐号在游戏内发布色情、种族主义、极端政治倾向、影响民族团结、危害国家安全或明显人身攻击的信息。
		</p>
	</div>
</div>

<?php
$css = <<<CSS
.jia-zhang-jian-hu-gong-cheng p{
	font-size: 14px;
}

.jia-zhang-jian-hu-gong-cheng ul li{
	font-size: 14px;
}

.jia-zhang-jian-hu-gong-cheng h4{
	line-height: 20px;
	font-weight: bold;
	font-size: 16px;
}
CSS;
$this->registerCss($css);

?>
