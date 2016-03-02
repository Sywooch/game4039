<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/29
 * Time: 14:28
 * Desc: 活动首页
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use common\util\Buuug7Util;

$this->title = '活动';
?>
<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">活动中心</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/site/index') ?>">首页</a></li>
			<li class="active">活动</li>
		</ul>
	</div>
</div>
<?php $this->endBlock(); ?>

<div class="container content">
	<div class="cube-portfolio">
		<div class="content-xs padding-top-0">

			<!-- Filter Container-->
			<div id="filters-container-activities" class="cbp-l-filters-text content-xs">
				<div data-filter="*" class="cbp-filter-item-active cbp-filter-item buuug7-font-size-18"> 全部活动</div>
				<?php foreach (Buuug7Util::getActivityCat() as $cat): ?>
					|
					<div data-filter="<?= '.' . $cat->slug ?>"
						 class="cbp-filter-item buuug7-font-size-18"> <?= $cat->title ?></div>
				<?php endforeach; ?>
			</div>
			<!--/end Filters Container-->

		</div>
		<div id="grid-container-activities">
			<?php foreach (Buuug7Util::getActivityCat() as $cat2): ?>
				<?php foreach (Buuug7Util::getActivitiesDataProviderByCatSlug($dataProvider, $cat2->slug)->models as $activities): ?>
					<div class="<?= 'cbp-item ' . $cat2->slug ?> ">

						<div class="easy-block-v2">
							<div
								class="easy-bg-v2 rgba-default"><?= StringHelper::truncate($cat2->title, 2, '') ?></div>

							<?= Html::a(Html::img(Yii::$app->glide->createSignedUrl([
								'glide/index',
								'path' => $activities->thumbnail_path,
							], true)), ['view', 'slug' => $activities->slug]) ?>

							<h4><?= $activities->title ?></h4>

							<p><?= StringHelper::truncate($activities->description, 22) ?></p>
							<ul class="list-unstyled">
								<li><span
										class="color-green">开始时间 : </span><?= Yii::$app->formatter->asDate($activities->start_time) ?>
								</li>
								<li><span
										class="color-green">结束时间 : </span><?= Yii::$app->formatter->asDate($activities->end_time) ?>
								</li>
							</ul>
							<?php if ($activities->end_time < time()): ?>
								<a href="" class="btn-u btn-u-default "><i class="fa fa-clock-o"></i> 已经结束</a>
							<?php else: ?>
								<a href="<?= Url::to(['view', 'slug' => $activities->slug]) ?>" class="btn-u "><i
										class="fa fa-clock-o"></i> 立即参加</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="text-center">
		<?= \yii\widgets\LinkPager::widget([
			'pagination' => $dataProvider->pagination
		]) ?>
	</div>
</div>


<?php
//\frontend\assets\HandlebarsAsset::register($this);
$js = <<<JS
jQuery(document).ready(function() {
    //make user-nav active
    $('.index-nav').removeClass('active');
    $('.activity-nav').addClass('active');

    App.init();
    var gridContainerActivities = jQuery('#grid-container-activities'),
        filtersContainerActivities = $('#filters-container-activities');

    gridContainerActivities.cubeportfolio({
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
        displayType: 'lazyLoading',
        displayTypeSpeed: 1000,
        animationType: "rotateSides",
    });


    //add listener for filters
    if (filtersContainerActivities. hasClass('cbp-l-filters-dropdown')) {
        wrap = filtersContainerActivities.find('.cbp-l-filters-dropdownWrap');

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

    filtersContainerActivities.on('click.cbp', '.cbp-filter-item', function() {
        var me = $(this);

        if (me.hasClass('cbp-filter-item-active')) {
            return;
        }

        // get cubeportfolio data and check if is still animating (reposition) the items.
        if (!$.data(gridContainerActivities[0], 'cubeportfolio').isAnimating) {
            filtersCallback.call(null, me);
        }

        // filter the items
        gridContainerActivities.cubeportfolio('filter', me.data('filter'), function() {
        });
    });
});
JS;

$this->registerJS($js);
?>
