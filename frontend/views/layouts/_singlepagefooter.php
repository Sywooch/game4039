<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/30
 * Time: 18:04
 * Desc:
 */
use yii\helpers\Url;
?>
<!--footer-->
<div id="footer-default" class="footer-default">
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
