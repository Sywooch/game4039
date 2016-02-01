<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/2/1
 * Time: 16:46
 * Desc:
 */

$this->title = "我的消息";
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
					<div class="panel panel-profile">
						<div class="panel-heading overflow-h">
							<h2 class="panel-title heading-sm pull-left"><i class="fa fa-comments"></i>我的消息</h2>
							<a href="#"><i class="fa fa-cog pull-right"></i></a>
						</div>
						<div class="panel-body margin-bottom-50">
							<?php foreach ($dataProvider->models as $model): ?>
								<div class="media media-v2">
									<div class="media-body">
										<h4 class="media-heading">
											<strong><a href="#"><?= $model->title ?></a></strong>
											<small><?= Yii::$app->formatter->asRelativeTime($model->created_at) ?></small>
										</h4>
										<p>
											<?= $model->content; ?>
										</p>
									</div>
								</div>
								<!--/end media media v2-->
							<?php endforeach; ?>
							<div class="text-center">
								<?= \yii\widgets\LinkPager::widget([
									'pagination' => $dataProvider->pagination
								]) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--/container-->
	</div>
</div>
<!--end profile-->

<?php
$js = <<<JS
jQuery(document).ready(function() {
//make user-nav active
$('.index-nav').removeClass('active');
$('.user-nav').addClass('active');

//make user-history sidebar nav active
$('.user-message').addClass('active');

        App.init();
        //App.initCounter();
        //App.initScrollBar();
        //Datepicker.initDatepicker();
    });
JS;
$this->registerJs($js);
?>
