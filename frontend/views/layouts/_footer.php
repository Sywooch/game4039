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
							<a href="#"><?= $links->name ?></a>
						<?php endforeach; ?>
					</ul>
					<!-- End Frirend Links -->
				</div>
				<!--/col-md-4-->

				<div class="col-md-4 md-margin-bottom-40">
					<!-- Recent Blogs -->
					<div class="posts">
						<div class="headline"><h2>最新资讯</h2></div>
						<dl class="dl-horizontal">
							<?php foreach (Buuug7Util::getRecentArticles() as $article): ?>
								<dt><a href="#"><?= Html::img(Yii::$app->glide->createSignedUrl([
											'glide/index',
											'path' => $article->thumbnail_path,
											'w' => 100
										], true)) ?></a>
								</dt>
								<dd>
									<p><a href="#"><?= StringHelper::truncate($article->description, 25) ?></a></p>
								</dd>
							<?php endforeach; ?>
						</dl>
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
					<ul class="social-icons">
						<li><a href="#" data-original-title="Feed" class="social_rss"></a></li>
						<li><a href="#" data-original-title="vKontakte" class="social_vk"></a></li>
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
						<img class="pull-right" id="logo-footer" src="<?= Url::to(['/img/logo_4039.png']) ?>" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/copyright-->

<!--end footer-->