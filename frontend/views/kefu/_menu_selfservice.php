<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/4
 * Time: 12:01
 * Desc:
 */
use yii\helpers\Url;
?>

<div class="header margin-bottom-40">
	<ul class="nav navbar-nav">
		<li class="jian-yi">
			<a href="<?= Url::to(['kefu/jian-yi'])?>">建议 </a>
		</li>
		<li class="bug-fan-kui">
			<a href="<?= Url::to(['/kefu/bug-fan-kui'])?>">bug反馈 </a>
		</li>
		<li class="tou-su">
			<a href="<?= Url::to(['/kefu/tou-su'])?>">投诉 </a>
		</li>
		<li class="jie-guo ">
			<a href="<?= Url::to(['/kefu/selfservice-result'])?>">结果查询 </a>
		</li>
	</ul>
</div>
