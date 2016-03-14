<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/23
 * Time: 14:40
 * Desc:
 */
//\common\util\Buuug7Util::addUserHistory(4);
?>

<!--frofile-->
<div class="container content">
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
					<div class="headline"><h2>最近玩的游戏</h2></div>

					<!--timeline user history-->
					<ul class="timeline-v2">
						<?php foreach ($dataProvider->models as $model): ?>
							<li>
								<time class="cbp_tmtime" datetime="">
									<span><?= Yii::$app->formatter->asDate($model->created_at) ?></span>
									<span><?= Yii::$app->formatter->asRelativeTime($model->created_at) ?></span></time>
								<i class="cbp_tmicon rounded-x hidden-xs"></i>

								<div class="cbp_tmlabel">
									<h4>你玩过 : <?= $model->server->server_name ?></h4>

									<p>
										<button class="btn-u btn-brd  btn-u-xs" type="button"> 官网</button>
										<button class="btn-u btn-brd  btn-u-xs" type="button"> 论坛</button>
									</p>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
					<div class="text-center">
						<?= \yii\widgets\LinkPager::widget([
							'pagination' => $dataProvider->pagination
						]) ?>
					</div>
					<!--end timeline user history-->

				</div>
				<!-- End Profile Content -->
			</div>
		</div>
		<!--/container-->
	</div>
</div>
<!--end profile-->

<?php
$js = <<<JS
//make user-nav active
$('.index-nav').removeClass('active');
$('.user-nav').addClass('active');

//make user-history sidebar nav active
$('.user-history').addClass('active');

App.init();
//App.initCounter();
//App.initScrollBar();
 //Datepicker.initDatepicker();

JS;
$this->registerJs($js);
?>
