<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Article
 */
use yii\helpers\Html;

?>

<div class="row margin-bottom-20">
	<div class="col-sm-5 sm-margin-bottom-20">
		<?php if ($model->thumbnail_path): ?>
			<?= Html::a(Html::img(
				Yii::$app->glide->createSignedUrl([
					'glide/index',
					'path' => $model->thumbnail_path,
				], true),
				['class' => 'img-responsive']
			), ['view', 'slug' => $model->slug]) ?>
		<?php endif; ?>
	</div>

	<div class="col-sm-7 news-v3">
		<div class="news-v3-in-sm no-padding">
			<ul class="list-inline posted-info">
				<li>By <?= $model->author->username ?></li>
				<li><?php echo Html::a(
						$model->category->title,
						['index', 'ArticleSearch[category_id]' => $model->category_id]
					) ?>
				</li>
				<li><?php echo Yii::$app->formatter->asDatetime($model->published_at) ?></li>
			</ul>
			<h2>
				<?= Html::a($model->title, ['view', 'slug' => $model->slug]) ?>
			</h2>

			<p><?php echo \yii\helpers\StringHelper::truncate($model->description, 100, '...', null, true) ?></p>
			<ul class="post-shares post-shares-lg">
				<li>
					<a href="javascript:void(0);">
						<i class="rounded-x icon-eye"></i>
						<span>
							<?php
							if ($model->click && $model->click > 999)
							{
								echo '999+';
							} else
							{
								echo $model->click ? $model->click : 0;
							}
							?>
						</span>
					</a>
				</li>
				<li><a href="javascript:void(0)"><i class="rounded-x icon-share share<?= $model->id ?>"></i></a></li>
				<li><a href="javascript:void(0)"><i
							class="rounded-x  icon-like like-click"></i><span><?= $model->stars ?></span></a></li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<!-- JiaThis Button BEGIN -->
					<div class="jiathis_style margin-top-15 share-body-<?= $model->id ?>" style="display: none">
						<span class="jiathis_txt">分享到：</span>
						<a class="jiathis_button_tools_1"></a>
						<a class="jiathis_button_tools_2"></a>
						<a class="jiathis_button_tools_3"></a>
						<a class="jiathis_button_tools_4"></a>

						<a href="http://www.jiathis.com/share"
						   class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
						<a class="jiathis_counter_style"></a>
					</div>
					<script type="text/javascript">
						var jiathis_config = {
							summary: "",
							shortUrl: true,
							hideMore: false
						}
					</script>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
					<!-- JiaThis Button END -->

				</div>
			</div>


		</div>
	</div>
</div>
<!--/end row-->
<!-- End News v3 -->

<div class="clearfix margin-bottom-20">
	<hr>
</div>

<?php
$js = <<<JS
//hide or show jia this share button
var flagShare=0;
$(".share{$model->id}").click(function(){
	if(flagShare==0){
		$(".share-body-{$model->id}").show();
		flagShare=1;
	}else{
		$(".share-body-{$model->id}").hide();
		flagShare=0;
	}
});

JS;

$this->registerJs($js);
