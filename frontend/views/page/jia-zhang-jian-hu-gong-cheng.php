<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/2/2
 * Time: 11:19
 * Desc:家长监护
 */

$this->title = '家长监护工程';
?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs-v3 img-v3 text-center">
	<div class="container">
		<h1>家长监护工程</h1>

		<p>4039游戏旨在对未成年玩家合法权益的关注以及对用实际行动营造和谐社会的愿望.</p>
	</div>
	<!--/end container-->
</div>
<?php $this->endBlock(); ?>

<div class="container content-sm">
	<div class="headline-center margin-bottom-60">
		<h2><?= $model->title ?></h2>
	</div>
	<div class="jia-zhang-jian-hu-gong-cheng">
		<p class="lead">
			&nbsp;&nbsp;&nbsp;&nbsp;“网络游戏未成年人家长监护工程”是一项由37游戏平台根据国家有关规定而发起的一个项目，
			由中华人民共和国文化部指导，旨在加强家长对未成年人参与网络游戏的监护，引导未成年人健康、绿色参与网络游戏，和谐家庭关系的社会性公益行动。
			它提供了一种切实可行的方法，一种家长实施监控的管道，使家长纠正部分未成年子女沉迷游戏的行为成为可能。该项社会公益行动充分反映了中国网络游戏行业高度的社会责任感，
			对未成年玩家合法权益的关注及对用实际行动营造和谐社会的愿望。
		</p>
		<br>

		<h4>未成年人健康参与网络游戏提示</h4>

		<p>
			随着网络在青少年中的普及，未成年人接触网络游戏已经成为普遍现象。为保护未成年人健康参与游戏，在政府进一步加强行业管理的前提下，家长也应当加强监护引导。为此，我们为未成年人参与网络游戏提供以下意见：</p>
		<ul>
			<li>主动控制游戏时间。游戏只是学习、生活的调剂，要积极参与线下的各类活动，并让父母了解自己在网络游戏中的行为和体验。</li>
			<li>不参与可能耗费较多时间的游戏设置。不玩大型角色扮演类游戏，不玩有PK类设置的游戏。在校学生每周玩游戏不超过2小时，每月在游戏中的花费不超过10元。</li>
			<li>不要将游戏当作精神寄托。尤其在现实生活中遇到压力和挫折时，应多与家人朋友交流倾诉，不要只依靠游戏来缓解压力。</li>
			<li>养成积极健康的游戏心态。克服攀比、炫耀、仇恨和报复等心理，避免形成欺凌弱小、抢劫他人等不良网络行为习惯。</li>
			<li>注意保护个人信息。包括个人家庭、朋友身份信息，家庭、学校、单位地址，电话号码等，防范网络陷阱和网络犯罪。</li>
		</ul>
		<br>

		<h4>家长监护申请流程</h4>

		<p>
			家长监护系统充分考虑家长的实际需求，当家长发现自己的孩子玩游戏过于沉迷的时候，
			由家长提供合法的监护人资质证明、游戏名称账号、以及家长对于限制强度的愿望等信息，
			可对处于孩子游戏沉迷状态的账号采取几种限制措施，解决未成年人沉迷网游的不良现象，
			如限制孩子每天玩游戏的时间区间和长度，也可以限制只有周末才可以游戏，或者完全禁止
		</p>
		<br>

		<h4>家长监护进度查询</h4>

		<p>
			如果您已经申请家长监护服务，您可以通过我们的点击这里给我发消息进行查询，
			了解您所提交的服务申请最新处理进展，如：传真是否收到，是否需要后续提交信息，
			账号是否已经进行处理等。服务期间，如果您对需要提交的信息或者处理结果有疑问，
			或者其他任何问题，您均可以随时联系我们，我们将由专门负责的客服主管为您提供咨询解答服务，或者配合、指导您解决问题。
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
