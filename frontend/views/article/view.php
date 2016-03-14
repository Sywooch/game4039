<?php
/* @var $this yii\web\View */
/* @var $model common\models\Article */

use yii\helpers\Html;
use yii\helpers\StringHelper;

$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->title = '资讯';
?>

<?php $this->beginBlock('breadcrumbs'); ?>
	<div class="breadcrumbs-v1">
		<div class="container">
			<span>资讯</span>

			<h1>最新的页游动态</h1>
		</div>
	</div>
<?php $this->endBlock(); ?>
	<div class="bg-color-light">
		<div class="container content-sm">
			<div class="row">
				<!-- Blog All Posts -->
				<div class="col-md-9">
					<!--news v3-->
					<div class="news-v3 bg-color-white margin-bottom-30">
						<div class="news-v3-in">
							<ul class="list-inline posted-info">
								<li>By <?= $model->author->username ?></li>
								<li><?php echo Html::a(
										$model->category->title,
										['index', 'ArticleSearch[category_id]' => $model->category_id]
									) ?></li>
								<li><?php echo Yii::$app->formatter->asDatetime($model->created_at) ?></li>
							</ul>
							<h2><?= Html::a($model->title, ['view', 'slug' => $model->slug]) ?></h2>
							<blockquote class="hero">
								<p><em><?= $model->description ?></em></p>
							</blockquote>
							<p><?= $model->body ?></p>
							<ul class="post-shares post-shares-lg">
								<li>
									<a href="javascript::void (0)">
										<i class="rounded-x icon-eye"></i>
										<span><?= $model->click ?></span>
									</a>
								</li>
								<li><a href="javascript::void (0)"><i
											class="rounded-x  icon-like icon-like<?= $model->id ?>"></i><span><?= $model->stars ?></span></a>
								</li>
							</ul>
							<div class="row">
								<div class="col-md-12">
									<!-- JiaThis Button BEGIN -->
									<div class="jiathis_style margin-top-15 share-body-<?= $model->id ?>">
										<span class="jiathis_txt">分享到：</span>
										<a class="jiathis_button_tools_1"></a>
										<a class="jiathis_button_tools_2"></a>
										<a class="jiathis_button_tools_3"></a>
										<a class="jiathis_button_tools_4"></a>

										<a href="http://www.jiathis.com/share"
										   class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis"
										   target="_blank">更多</a>
										<a class="jiathis_counter_style"></a>
									</div>
									<script type="text/javascript">
										var jiathis_config = {
											summary: "",
											shortUrl: true,
											hideMore: false
										}
									</script>
									<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js"
											charset="utf-8"></script>
									<!-- JiaThis Button END -->

								</div>
							</div>
						</div>
					</div>
					<!--end news v3-->
				</div>
				<!-- End Blog All Posts -->

				<!-- Blog Sidebar -->
				<div class="col-md-3">
					<div class="headline-v2"><h2>最新资讯</h2></div>
					<!-- Latest Links -->
					<ul class="list-unstyled blog-latest-posts margin-bottom-50">
						<?php foreach (\common\util\Buuug7Util::getRecentArticles() as $article): ?>
							<li>
								<h3><?= Html::a($article->title, ['view', 'slug' => $article->slug]) ?></h3>
								<small><?= Yii::$app->formatter->asDate($article->published_at) ?></small>
								<p><?= StringHelper::truncate($article->description, 20, '...') ?></p>
							</li>
						<?php endforeach; ?>

					</ul>
					<!-- End Latest Links -->

					<div class="headline-v2"><h2>标签</h2></div>
					<!-- Tags v2 -->
					<ul class="list-inline tags-v2 margin-bottom-50">
						<?php foreach (\common\models\ArticleCategory::find()->all() as $articleCat): ?>
							<li><?php echo Html::a($articleCat->title, ['index', 'ArticleSearch[category_id]' => $articleCat->id]) ?></li>
						<?php endforeach; ?>
					</ul>
					<!-- End Tags v2 -->
				</div>
				<!-- End Blog Sidebar -->
			</div>
		</div>
	</div>

<?php
//计数浏览次数
$model->addClick();
$addStarsUrl=\yii\helpers\Url::to(['/article/add-stars']);

$js = <<<JS
App.init();
//make user-nav active
$('.index-nav').removeClass('active');
$('.zixun-nav').addClass('active');

//collect users praise
$(".icon-like{$model->id}").on('click',function(event){
	event.preventDefault();
	var el = $(this);
	if(el.hasClass('praised')){
		layer.msg('你已经点过赞啦!~');
	}else{
		$.ajax({
			url : "{$addStarsUrl}",
			data : {
				id : {$model->id}
			},
			success : function(data){
				el.addClass('praised');
                el.next().text(parseInt(el.next().text()) + 1);
                layer.msg('点赞成功!~@~');
			}
		});
	}
});

JS;

$this->registerJs($js);