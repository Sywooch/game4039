<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/25
 * Time: 18:56
 * Desc:
 */

$this->title = '用户积分';

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
					<div class="row margin-bottom-10">
						<div class="col-sm-12 sm-margin-bottom-20">
							<div class="headline"><h2>我的积分</h2></div>
							<div class="service-block-v3 service-block-u">
								<i class="icon-bag"></i>
								<span class="service-heading">可用积分</span>
								<span class="counter"><?= $dzUser['credits'] ?></span>

								<div class="clearfix margin-bottom-10"></div>

								<div class="statistics">
									<h3 class="heading-xs">还差296点积分就升级啦!<span class="pull-right"><?= $dzUser['credits'] ?>/300</span>
									</h3>

									<div class="progress progress-u progress-xxs">
										<div style="width: 67%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="67"
											 role="progressbar" class="progress-bar progress-bar-light">
										</div>
									</div>
									<small><strong>Lv.0</strong></small>
								</div>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-10">
						<div class="col-sm-12">
							<blockquote class="">
								<h5>常见问题</h5>
								<h5><a href="">什么是积分？</a></h5>
								<h5><a href="">如何查询我的积分？</a></h5>
								<h5><a href="">积分如何使用？</a></h5>
							</blockquote>
						</div>

					</div>

				</div>
				<!-- End Profile Content -->
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
$('.user-credits').addClass('active');

        App.init();
        //App.initCounter();
        //App.initScrollBar();
        //Datepicker.initDatepicker();
    });
JS;
$this->registerJs($js);
?>
