<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */

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
	<div class="container content-md">
		<div class="row">
			<!-- Blog All Posts -->
			<div class="col-md-9">
				<!-- News v3 -->
				<?php echo \yii\widgets\ListView::widget([
					'dataProvider' => $dataProvider,
					'layout' => "{items}",
					'pager' => [
						'hideOnSinglePage' => true,
					],
					'itemView' => '_item'
				]) ?>


				<!-- Pager v3 -->
				<?= \yii\widgets\LinkPager::widget([
					'pagination' => $dataProvider->pagination,
					'options' => [
						'class' => 'pager pager-v3 pager-sm no-margin-bottom',
					],
					'prevPageCssClass' => 'previous',
					'prevPageLabel' => '←',
					'nextPageLabel' => '→',
				]) ?>
				<!-- End Pager v3 -->
			</div>
			<!-- End Blog All Posts -->

			<!-- Blog Sidebar -->
			<div class="col-md-3">
				<div class="headline-v2 bg-color-light"><h2>最新资讯</h2></div>
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

				<div class="headline-v2 bg-color-light"><h2>标签</h2></div>
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


<?php
$js = <<<JS
//make user-nav active
$('.index-nav').removeClass('active');
$('.zixun-nav').addClass('active');
App.init();

JS;
$this->registerJs($js);
$this->registerCssFile('@web/unify/assets/plugins/line-icons/line-icons.css');
?>