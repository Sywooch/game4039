<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use common\util\Buuug7Util;

$this->title = Yii::$app->name;
?>

<?php $this->beginBlock('slider'); ?>
<!--slider-->
<div class="tp-banner-container">
	<div class="tp-banner">
		<ul>
			<?php foreach (Buuug7Util::getActiveIndexSlide() as $slide): ?>
				<!-- SLIDE -->
				<li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000"
					data-title="Slide 1">
					<!-- MAIN IMAGE -->
					<?= Html::img(Yii::$app->glide->createSignedUrl(['glide/index',
						'path' => $slide->thumbnail_path,], true), ['data-transition' => 'fade', 'alt' => $slide->name, 'data-bgfit' => 'cover', 'data-bgposition' => 'left top', 'data-bgrepeat' => 'no-repeat']) ?>

					<div class="tp-caption revolution-ch1 sft start"
						 data-x="center"
						 data-hoffset="0"
						 data-y="100"
						 data-speed="1500"
						 data-start="500"
						 data-easing="Back.easeInOut"
						 data-endeasing="Power1.easeIn"
						 data-endspeed="300">
						<?= $slide->caption ?>
					</div>

					<!-- LAYER -->
					<div class="tp-caption revolution-ch2 sft"
						 data-x="center"
						 data-hoffset="0"
						 data-y="190"
						 data-speed="1400"
						 data-start="2000"
						 data-easing="Power4.easeOut"
						 data-endspeed="300"
						 data-endeasing="Power1.easeIn"
						 data-captionhidden="off"
						 style="z-index: 6">
						<?= $slide->description ?>
					</div>

					<!-- LAYER -->
					<div class="tp-caption sft"
						 data-x="center"
						 data-hoffset="0"
						 data-y="310"
						 data-speed="1600"
						 data-start="2800"
						 data-easing="Power4.easeOut"
						 data-endspeed="300"
						 data-endeasing="Power1.easeIn"
						 data-captionhidden="off"
						 style="z-index: 6">
						<a href="<?= $slide->access_url ?>" class="btn-u btn-brd btn-brd-hover btn-u-light">进入游戏</a>
						<a href="<?= $slide->official_url ?>" class="btn-u btn-brd btn-brd-hover btn-u-light">官网</a>
					</div>
				</li>
				<!-- END SLIDE -->
			<?php endforeach; ?>
		</ul>
		<div class="tp-bannertimer tp-bottom"></div>
	</div>
</div>
<!--end slider-->
<?php $this->endBlock(); ?>

<div class="container content">
	<div class="row">
		<!--main-->
		<div class="col-lg-9">
			<div class="row margin-bottom-20">
				<div class="col-lg-12">
					<div class="headline"><h2>游戏</h2></div>
				</div>
				<div class="col-lg-12 md-margin-bottom-40">
					<!--games-->
					<div class="cube-portfolio">
						<div class="content-xs padding-top-0">
							<div id="filters-container" class="cbp-l-filters-text content-xs">
								<div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> 所有</div>
								|
								<div data-filter=".recommend" class="cbp-filter-item">推荐</div>
								|
								<div data-filter=".jingping" class="cbp-filter-item">精品</div>
							</div>
							<!--/end Filters Container-->
						</div>
						<div id="grid-container" class="cbp-l-grid-agency">
							<!--recomend games-->
							<?php foreach (Buuug7Util::getGameByFlag(true) as $games): ?>
								<div class="cbp-item recommend">
									<div class="cbp-caption margin-bottom-20">
										<div class="cbp-caption-defaultWrap">
											<?= Html::img(Yii::$app->glide->createSignedUrl(['glide/index',
												'path' => $games->thumbnail_path], true), ['alt' => $games->name]) ?>
										</div>
										<div class="cbp-caption-activeWrap">
											<div class="cbp-l-caption-alignCenter">
												<div class="cbp-l-caption-body">
													<ul class="link-captions no-bottom-space">
														<li><a href="<?= Url::to(['/game/view', 'slug' => $games->slug]) ?>">
																<button class="btn-u btn-u-xs btn-u-blue"
																		type="button">
																	进入游戏
																</button>
															</a></li>
														<li><a href="javascript:void(0);" class=""
															   data-title="Design Object">
																<button class="btn-u btn-u-xs btn-u-red"
																		type="button">
																	官网
																</button>
															</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="cbp-title-dark">
										<div class="cbp-l-grid-agency-title"><a
												href="<?= Url::to(['/game/view', 'slug' => $games->slug]) ?>"><?= $games->name ?></a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
							<!--/end recommend games-->

							<!--recomend games-->
							<?php foreach (Buuug7Util::getGameByFlag() as $games): ?>
								<div class="cbp-item jingping">
									<div class="cbp-caption margin-bottom-20">
										<div class="cbp-caption-defaultWrap">
											<?= Html::img(Yii::$app->glide->createSignedUrl(['glide/index',
												'path' => $games->thumbnail_path], true), ['alt' => $games->name]) ?>
										</div>
										<div class="cbp-caption-activeWrap">
											<div class="cbp-l-caption-alignCenter">
												<div class="cbp-l-caption-body">
													<ul class="link-captions no-bottom-space">
														<li><a href="<?= Url::to(['/game/view', 'slug' => $games->slug]) ?>">
																<button class="btn-u btn-u-xs btn-u-blue"
																		type="button">
																	进入游戏
																</button>
															</a></li>
														<li><a href="" class=""
															   data-title="Design Object">
																<button class="btn-u btn-u-xs btn-u-red"
																		type="button">
																	官网
																</button>
															</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="cbp-title-dark">
										<div class="cbp-l-grid-agency-title"><a
												href="<?= Url::to(['/game/view', 'slug' => $games->slug]) ?>"><?= $games->name ?></a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
							<!--/end recommend games-->

						</div>
						<!--/end Grid Container-->
					</div>
					<!--end games-->
				</div>
				<!--/col-md-8-->
			</div>

			<!--activities-->
			<div class="row margin-bottom-20">
				<div class="col-lg-12">
					<div class="headline"><h2>精彩活动</h2></div>
				</div>
				<?php foreach (Buuug7Util::getActivitiesByLimit(5) as $activities): ?>
					<div class="col-md-3 col-sm-6 md-margin-bottom-40">
						<div class="easy-block-v2">
							<div
								class="easy-bg-v2 rgba-default"><?= StringHelper::truncate($activities->category->title, 2, '') ?></div>
							<?= Html::a(Html::img($activities->getThumbnailUrl()), ['/activities/view', 'slug' => $activities->slug]) ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<!--/end activites-->

			<!--players-->
			<div class="row margin-bottom-20">
				<div class="col-md-4 md-margin-bottom-20">
					<div class="headline"><h2>玩家相册</h2></div>
					<div id="myCarousel" class="carousel slide carousel-v1">
						<div class="carousel-inner">
							<?php foreach (Buuug7Util::getStatusInUsePlayerAlbum() as $k => $albums): ?>
								<div class="item <?php if ($k == 0)
								{
									echo 'active';
								} ?>">
									<?= Html::img(Yii::$app->glide->createSignedUrl(['glide/index',
										'path' => $albums->thumbnail_path,], true)) ?>
									<div class="carousel-caption">
										<p><?= $albums->user->username ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>

						<div class="carousel-arrow">
							<a class="left carousel-control" href="#myCarousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<!--/row-->
			<!--end plyers-->

			<!--abount us-->
			<div class="row margin-bottom-20">
				<div class="col-md-7 md-margin-bottom-40">
					<div class="headline"><h2>关于我们</h2></div>
					<div class="row">
						<div class="col-sm-12">
							<p>4039.com是一家专业的网页游戏平台,在这里你可以体验到最新最好的网页游戏.</p>
							<ul class="list-unstyled margin-bottom-20">
								<li><i class="fa fa-check color-green"></i> 拥有最专业的技术团队</li>
								<li><i class="fa fa-check color-green"></i> 公平公正,杜绝一切影响到游戏公平的行为</li>
								<li><i class="fa fa-check color-green"></i> 最新,最热门游戏</li>
								<li><i class="fa fa-check color-green"></i> 及时的客服支持</li>
							</ul>
						</div>
					</div>
					<blockquote class="hero-unify">
						<p>玩家想要的就是我们致力于的</p>
						<small>CEO, Mr Sun</small>
					</blockquote>
				</div>
				<!--/col-md-8-->
			</div>
			<!--end abount us-->
		</div>

		<!--aside-->
		<div class="col-lg-3">

			<!--gameserver-->
			<div class="row">
				<div class="col-md-12">
					<div class="who margin-bottom-30">
						<div class="headline"><h3>最新开服</h3></div>
						<p class="">这里是最新开服的页游,欢迎体验</p>
						<ul class="list-unstyled">
							<?php foreach (Buuug7Util::getStatusInUseGameServer() as $servers): ?>
								<li><a href="#"><i class="fa fa-circle"></i><?= $servers->server_name ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<!--end gameserver-->

			<!--recent articles-->
			<div class="row">
				<div class="col-md-12">
					<div class="margin-bottom-50">
						<div class="headline"><h3>最新资讯</h3></div>
						<?php foreach (Buuug7Util::getRecentArticles() as $article): ?>
							<div class="blog-thumb blog-thumb-circle">
								<div class="blog-thumb-hover">
									<?= Html::img($article->thumbnail_base_url . '/' . $article->thumbnail_path, ['alt' => $article->title]) ?>
									<a class="hover-grad" href=""><i class="fa fa-link"></i></a>
								</div>
								<div class="blog-thumb-desc">
									<h3>
										<a href="<?= Url::to(['article/view', 'slug' => $article->slug]) ?>"><?= $article->title ?></a>
									</h3>
									<ul class="blog-thumb-info">
										<li><?= Yii::$app->formatter->asRelativeTime($article->published_at) ?></li>
										<li><a href="#"><i class="fa fa-thumbs-up"></i><?= $article->stars ?></a></li>
									</ul>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<!--end recent articles-->
		</div>
	</div>
</div>


<?php
$js = <<<JS
    App.init();

    //revolution slide
    var RevolutionSlider = function() {
        return {

            //Revolution Slider - Full Width
            initRSfullWidth: function() {
                var revapi;
                jQuery(document).ready(function() {
                    revapi = jQuery('.tp-banner').revolution({
                        delay: 9000,
                        startwidth: 1170,
                        startheight: 500,
                        hideThumbs: 10,
                        navigationStyle: "preview4"
                    });
                });
            },

            //Revolution Slider - Full Screen Offset Container
            initRSfullScreenOffset: function() {
                var revapi;
                jQuery(document).ready(function() {
                    revapi = jQuery('.tp-banner').revolution({
                        delay: 15000,
                        startwidth: 1170,
                        startheight: 400,
                        hideThumbs: 10,
                        fullWidth: "off",
                        fullScreen: "on",
                        hideCaptionAtLimit: "",
                        dottedOverlay: "twoxtwo",
                        navigationStyle: "preview4",
                        fullScreenOffsetContainer: ".header"
                    });
                });
            }
        };
    }();
    RevolutionSlider.initRSfullWidth();

    //cube init
    (function($, window, document, undefined) {
        'use strict';
        var gridContainer = $('#grid-container'),
            filtersContainer = $('#filters-container'),
            wrap, filtersCallback;

        //init cubeportfolio
        gridContainer.cubeportfolio({
            layoutMode: 'grid',
            rewindNav: true,
            scrollByPage: false,
            defaultFilter: '*',
            animationType: 'slideLeft',
            gapHorizontal: 20,
            gapVertical: 20,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 800,
                cols: 4
            }, {
                width: 500,
                cols: 2
            }, {
                width: 320,
                cols: 1
            }],
            caption: 'zoom',
            displayType: 'lazyLoading',
            displayTypeSpeed: 100
        });

        //add listener for filters
        if (filtersContainer.hasClass('cbp-l-filters-dropdown')) {
            wrap = filtersContainer.find('.cbp-l-filters-dropdownWrap');

            wrap.on({
                'mouseover.cbp': function() {
                    wrap.addClass('cbp-l-filters-dropdownWrap-open');
                },
                'mouseleave.cbp': function() {
                    wrap.removeClass('cbp-l-filters-dropdownWrap-open');
                }
            });

            filtersCallback = function(me) {
                wrap.find('.cbp-filter-item').removeClass('cbp-filter-item-active');
                wrap.find('.cbp-l-filters-dropdownHeader').text(me.text());
                me.addClass('cbp-filter-item-active');
                wrap.trigger('mouseleave.cbp');
            };
        } else {
            filtersCallback = function(me) {
                me.addClass('cbp-filter-item-active').siblings().removeClass('cbp-filter-item-active');
            };
        }

        filtersContainer.on('click.cbp', '.cbp-filter-item', function() {
            var me = $(this);

            if (me.hasClass('cbp-filter-item-active')) {
                return;
            }

            // get cubeportfolio data and check if is still animating (reposition) the items.
            if (!$.data(gridContainer[0], 'cubeportfolio').isAnimating) {
                filtersCallback.call(null, me);
            }

            // filter the items
            gridContainer.cubeportfolio('filter', me.data('filter'), function() {});
        });

        //activate counter for filters
        gridContainer.cubeportfolio('showCounter', filtersContainer.find('.cbp-filter-item'), function() {
            // read from url and change filter active
            var match = /#cbpf=(.*?)([#|?&]|$)/gi.exec(location.href),
                item;
            if (match !== null) {
                item = filtersContainer.find('.cbp-filter-item').filter('[data-filter="' + match[1] + '"]');
                if (item.length) {
                    filtersCallback.call(null, item);
                }
            }
        });
    })(jQuery, window, document);
JS;
$this->registerJs($js);
?>
