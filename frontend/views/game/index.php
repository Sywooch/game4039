<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/15
 * Time: 11:16
 * Desc:
 */
use yii\helpers\Url;
use yii\bootstrap\Html;
use common\util\Buuug7Util;


$this->title = '游戏中心';

//myVarDump($dataProvider->query);
?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">游戏中心</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/site/index') ?>">首页</a></li>
			<li class="active">游戏中心</li>
		</ul>
	</div>
</div>
<?php $this->endBlock(); ?>

<div class="container content">

	<div class="row magazine-page">
		<!-- Begin Content -->
		<div class="col-md-9">
			<div class="headline"><h3>游戏列表</h3></div>
			<div class="game-list" id="gameList">
				<div class="game-list-select" id="gameListSelect">
					<p data-key="game_type">
						<strong>游戏类型：</strong>
						<a href="javascript:;" class="focus" data-target="0">不限</a>
						<?php foreach(\common\models\GameCategory::find()->all() as $gameCat):?>
							<?= Html::a($gameCat->title,['index','GameSearch[category_id]' => $gameCat->id])?>
						<?php endforeach;?>
					</p>

					<p class="game-list-select-last" data-key="pinyin">
						<strong>字母排序：</strong>
						<a href="javascript:;" class="focus" data-target="0">不限</a>
						<?= Html::a('ABCDE',['index','GameSearch[short]' => 'a,b,c,d,e'])?>
						<?= Html::a('FGHIJK',['index','GameSearch[short]' => 'f,g,h,i,j,k'])?>
						<?= Html::a('LMNOP',['index','GameSearch[short]' => 'l,m,n,o,p'])?>
						<?= Html::a('QRSTU',['index','GameSearch[short]' => 'q,r,s,t,u'])?>
						<?= Html::a('WX',['index','GameSearch[short]' => 'w,x'])?>
						<?= Html::a('YZ',['index','GameSearch[short]' => 'y,z'])?>
					</p>
				</div>
			</div>


			<!--games-->
			<div class="cube-portfolio">
				<div id="grid-container" class="cbp-l-grid-agency">
					<!--recomend games-->
					<?php foreach ($dataProvider->models as $games): ?>
						<div class="cbp-item recommend">
							<div class="cbp-caption margin-bottom-20">
								<div class="cbp-caption-defaultWrap">
									<?= Html::img(Yii::$app->glide->createSignedUrl([
										'glide/index',
										'path' => $games->thumbnail_path
									], true), ['alt' => $games->name]) ?>
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
												<li><a href="" class="cbp-lightbox"
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
								<div class="cbp-l-grid-agency-title"><a href="<?=Url::to(['/game/view','slug'=>$games->slug])?>"><?= $games->name ?></a></div>
							</div>
						</div>
					<?php endforeach; ?>
					<!--/end recommend games-->
				</div>
				<!--/end Grid Container-->
			</div>
			<!--end games-->

			<div class="text-center">
				<?= \yii\widgets\LinkPager::widget([
					'pagination' => $dataProvider->pagination
				]) ?>
			</div>
		</div>
		<!-- End Content -->

		<!-- Begin Sidebar -->
		<div class="col-md-3">

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
										<li><a href="#"><i class="fa fa-thumbs-up"></i><?= $article->stars ?></a>
										</li>
									</ul>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div>
				<script id='spay-script' src='https://jspay.beecloud.cn/1/pay/jsbutton/returnscripts?appId=8d185da4-aa11-4147-8267-6649381d850d'></script>
			</div>
			<!--end recent articles-->
		</div>
		<!-- End Sidebar -->
	</div>
</div>



<?php

$js = <<<JS
//make user-nav active
$('.index-nav').removeClass('active');
$('.game-nav').addClass('active');

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
            cols: 4
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

