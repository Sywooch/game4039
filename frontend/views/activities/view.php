<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/30
 * Time: 16:43
 * Desc: 活动->单页
 */

$this->title = $model->title;
?>

<!--=== Parallax Backgound ===-->
<div class="bg-image-v2 parallaxBg1">
	<div class="container">
		<div class="headline-center-v2 headline-center-v2-dark margin-bottom-10">
			<h2><?= $model->title ?></h2>
			<span class="bordered-icon"><i class="fa fa-th-large"></i></span>

			<p><?= $model->description ?></p><br><br>
			<button type="button" class="btn-u btn-brd btn-brd-hover btn-u-dark">立即参加</button>
		</div>
		<!--/Headline Center V2-->
	</div>
	<!--/container-->
</div>
<!--=== End Parallax Backgound ===-->

<!--=== Service Block ===-->
<div class="container content-sm">
	<div class="row">
		<div class="col-md-3 content-boxes-v6 md">
			<i class="rounded-x icon-clock"></i>
			<h1 class="title-v3-md text-uppercase margin-bottom-10">活动时间</h1>
			<p><?= Yii::$app->formatter->asDatetime($model->start_time).' 到 '.Yii::$app->formatter->asDatetime($model->end_time)?></p>
		</div>
		<div class="col-md-3 content-boxes-v6 md-margin-bottom-50">
			<i class="rounded-x  icon-check"></i>
			<h2 class="title-v3-md text-uppercase margin-bottom-10">活动规则</h2>
			<p> <?= $model->guize?></p>
		</div>
		<div class="col-md-3 content-boxes-v6">
			<i class="rounded-x icon-check"></i>
			<h2 class="title-v3-md text-uppercase margin-bottom-10">活动奖励</h2>
			<p><?= $model->jiangli?></p>
		</div>
		<div class="col-md-3 content-boxes-v6">
			<i class="rounded-x icon-check"></i>
			<h2 class="title-v3-md text-uppercase margin-bottom-10">领取奖励方法</h2>
			<p><?= $model->jiangli_fangfa?></p>
		</div>
	</div><!--/row-->
</div><!--/container-->
<!--=== End Service Block ===-->

<!--=== Parallax Backgound ===-->
<div class="bg-image-v2 bg-image-v2-dark parallaxBg1">
	<div class="container">
		<div class="headline-center-v2 margin-bottom-10">
			<p><?= $model->content?></p>
			<br>
		</div>
		<!--/Headline Center V2-->
	</div>
	<!--/container-->
</div>
<!--=== End Parallax Backgound ===-->

<!--=== Parallax Backgound ===-->
<div class="bg-image-v2 bg-image-v2-dark parallaxBg1">
	<div class="container">
		<div class="headline-center-v2 margin-bottom-10">
			<h2>4039游戏,你的选择,我的爱好</h2>
			<span class="bordered-icon"><i class="fa fa-th-large"></i></span>
			<p>
				本活动最终解释权归4039.com所有
			</p><br><br>
			<button type="button" class="btn-u btn-brd btn-brd-hover btn-u-light">立即体验</button>
		</div>
		<!--/Headline Center V2-->
	</div>
	<!--/container-->
</div>
<!--=== End Parallax Backgound ===-->

<?php
$css = <<<CSS

.bg-image-v2 {
    background: url({$model->getBgUrl()}) repeat fixed;
}
CSS;

$this->registerCss($css);

?>
