<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/23
 * Time: 17:46
 * Desc:
 */

use yii\helpers\Html;
use common\util\Buuug7Util;
$this->title = empty($profile->nickname) ? Html::encode($profile->user->username) : Html::encode($profile->nickname);
?>
<div class="container content">
	<!--frofile-->
	<div class="profile">
		<div class="row">
			<!--Left Sidebar-->
			<div class="col-md-3 md-margin-bottom-40 margin-bottom-40">
				<?= $this->render('../_userLeftSideBar'); ?>
			</div>
			<!--End Left Sidebar-->

			<!-- Profile Content -->
			<div class="col-md-9">
				<div class="profile-body">
					<div class="profile-bio">
						<div class="row">

							<div class="col-md-7">
								<h2><?= $this->title ?></h2>
							<span style="padding: 5px;"><strong>用户名
									:</strong> <?= Yii::$app->user->identity->username ?></span>
								<?php if (!empty($profile->website)): ?>
									<span style="padding: 5px;"><strong>邮箱 :</strong> <?= $profile->public_email ?></span>
								<?php endif; ?>

								<?php if (!empty($profile->location)): ?>
									<span style="padding: 5px;"><strong>地址
											:</strong> <?= Html::encode($profile->location) ?></span>
								<?php endif; ?>

								<?php if (!empty($profile->qq)): ?>
									<span style="padding: 5px;"><strong>QQ :</strong> <?= $profile->qq ?></span>
								<?php endif; ?>

								<hr>
								<p><strong>个性签名</strong> : <?= $profile->bio ?></p>
							</div>
							<!--<div class="col-md-5">
							<img class="img-responsive md-margin-bottom-10"
								 src="<?/*=// \common\util\UcenterUtil::getUserAvatar(Yii::$app->user->identity) */?>">
							<img src="http://gravatar.com/avatar/<?/*= $profile->gravatar_id  */?>?s=230" alt="" class="img-rounded img-responsive" />
						</div>-->
						</div>
					</div>
					<!--/end row-->
					<hr>

					<!--timeline-->
					<div class="panel panel-profile">
						<div class="panel-heading overflow-h">
							<h2 class="panel-title heading-sm pull-left"><i class="fa fa-yelp"></i> 最近动态</h2>
							<a href="#"><i class="fa fa-cog pull-right"></i></a>
						</div>
						<div class="panel-body margin-bottom-40">
							<ul class="timeline-v2 timeline-me">
								<?php foreach (Buuug7Util::getRecentUserHistory(Yii::$app->user->getId()) as $history): ?>
									<li>
										<time datetime="" class="cbp_tmtime">
											<span><?= Yii::$app->formatter->asDate($history->created_at, 'M月-d日') ?></span>
											<span><?= Yii::$app->formatter->asRelativeTime($history->created_at) ?></span>
										</time>
										<i class="cbp_tmicon rounded-x hidden-xs"></i>

										<div class="cbp_tmlabel">
											<h2><span class="text-info font-16">你玩过:</span><a href=""><?= $history->server->server_name ?></a></h2>
											<p>
												<?= $history->game->description ?>
											</p>
										</div>
									</li>

								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<!--end timeline-->
					<!--/end row-->
					<iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
				</div>
			</div>
		</div>
		<!--/container-->
	</div>
	<!--end profile-->
</div>


<?php
$js = <<<JS
jQuery(document).ready(function() {
//make user-nav active
$('.index-nav').removeClass('active');
$('.user-nav').addClass('active');

//make user-history sidebar nav active
$('.user-info').addClass('active');

        App.init();
        //App.initCounter();
        //App.initScrollBar();
        //Datepicker.initDatepicker();
    });
JS;
$this->registerJs($js);
?>
