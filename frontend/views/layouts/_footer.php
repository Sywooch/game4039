<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use common\util\Buuug7Util;

?>

<!--footer-->
<div id="footer-default" class="footer-default">
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4 md-margin-bottom-40">
					<!-- About -->
					<div class="headline"><h2>关于我们</h2></div>
					<p class="margin-bottom-25 md-margin-bottom-40"><?= Yii::$app->keyStorage->get('seo_description') ?></p>
					<!-- End About -->


					<!-- Frirend Links -->
					<div class="headline"><h2><?= Yii::t('common', 'Friend Links') ?></h2></div>
					<ul class="list-unstyled">
						<?php foreach (Buuug7Util::getLinks() as $links): ?>
							<a href="<?= $links->url?>" target="_blank"><?= $links->name ?></a>
						<?php endforeach; ?>
					</ul>
					<!-- End Frirend Links -->

					<!-- Frirend Links -->
					<div style="margin-top: 30px;">
						<div class="headline"><h2>网络监管</h2></div>
						<ul class="list-unstyled">
							<a href="<?= Url::to(['/page/jia-zhang-jian-hu-gong-cheng'])?>" style="">家长监护工厂</a>
							<a href="<?= Yii::$app->keyStorage->get('adverse_information_report_url')?>" target="_blank" style="margin-left: 5px;">不良信息举报</a>
						</ul>
					</div>

					<!-- End Frirend Links -->
				</div>
				<!--/col-md-4-->

				<div class="col-md-4 md-margin-bottom-40">
					<!-- Recent Blogs -->
					<div class="posts news-my-override">
						<div class="headline"><h2>最新资讯</h2></div>
						<ul class="list-unstyled link-news">

							<?php foreach (Buuug7Util::getRecentArticles() as $article): ?>
								<li>
									<a href="<?= Url::to(['/article/view', 'slug' => $article->slug]) ?>"><?= StringHelper::truncate($article->title, 25) ?></a>
									<small><?= Yii::$app->formatter->asDate($article->published_at)?></small>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<!-- End Recent Blogs -->
				</div>
				<!--/col-md-4-->

				<div class="col-md-4">
					<!-- Contact Us -->
					<div class="headline"><h2>联系我们</h2></div>
					<address class="md-margin-bottom-40">
						地址: <?= Yii::$app->keyStorage->get('site_address') ?><br>
						电话: <?= Yii::$app->keyStorage->get('site_phone') ?><br>
						Email: <a href="mailto:info@anybiz.com"
								  class=""><?= Yii::$app->keyStorage->get('mail_support') ?></a>
					</address>
					<!-- End Contact Us -->

					<!-- Social Links -->
					<div class="headline"><h2>保持联络</h2></div>
					<ul class="social-font-awesome clearfix ">
						<li><a href=""><i class="fa fa-lg fa-qq"></i></a></li>
						<li><a href=""><i class="fa fa-lg fa-weibo"></i></a></li>
						<li><a href=""><i class="fa fa-lg fa-wechat"></i></a></li>
					</ul>
					<!-- End Social Links -->
				</div>
				<!--/col-md-4-->
			</div>
		</div>
	</div>
	<!--/footer-->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<p>
						2015 © <?= Yii::$app->keyStorage->get('site_name') ?>. 版权所有.
						<a href="<?= Yii::$app->keyStorage->get('bei_an_url') ?>"
						   target="_blank"><?= Yii::$app->keyStorage->get('bei_an') ?></a> | <a
							href="<?= Yii::$app->keyStorage->get('wen_wang_wen_url') ?>"
							target="_blank"><?= Yii::$app->keyStorage->get('wen_wang_wen') ?></a>
					</p>
				</div>
				<div class="col-md-6">
					<a href="<?= Url::to(['/site/index']) ?>">
						<img class="pull-right" id="logo-footer" src="<?= Url::to(['@web/img/logo_4039.png']) ?>" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/copyright-->

<!--end footer-->