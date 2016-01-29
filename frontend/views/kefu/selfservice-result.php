<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/4
 * Time: 12:17
 * Desc:
 */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use common\models\KefuSelfservice;
use yii\grid\GridView;

$this->title = '自助服务 | 结果查询';
?>

<?= $this->render('_topSlider'); ?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">客服中心</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/kefu/index') ?>">客服中心</a></li>
			<li class="active">自助服务</li>
			<li class="active">投诉</li>
		</ul>
	</div>
</div>
<?php $this->endBlock(); ?>


<div class="container content">
	<div class="row">
		<div class="col-md-12">
			<?= $this->render('_menu_selfservice'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="tag-box tag-box-v3">
				<div class="headline"><h3><?= $this->title ?></h3></div>
				<?php if (!Yii::$app->user->isGuest): ?>
					<?php echo GridView::widget([

						'dataProvider' => $dataProvider,
						'columns' => [
							[
								'class' => 'yii\grid\ActionColumn',
								'header' => '操作',
								'template' => '{view}',
								'buttons' => [
									'view' => function ($url, $model, $key)
									{
										return Html::a('查看', $url);
									}
								],
							],
							//'id',
							'sn',
							[
								'attribute' => 'category_id',
								'value' => function ($dataProvider)
								{
									$cat = $dataProvider->category_id;
									return \common\models\KefuSelfserviceCat::findOne(['id' => $cat])['title'];
								}
							],
							//'content',
							'created_at:datetime',
							[
								'class' => \common\grid\EnumColumn::className(),
								'attribute' => 'status',
								'enum' => KefuSelfservice::getStatus(),
							],
						],
						'tableOptions' => [
							'class' => 'table table-bordered table-condensed table-hover table-striped',
							'id' => 'index scroll',

						],
						'layout' => "{items}\n{summary}\n{pager}",
					]) ?>
				<?php else: ?>
					<?= Html::tag('h5', '没有记录!') ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>


<?php

$js = <<<JS
jQuery(document).ready(function() {

$('.jie-guo').addClass('active');

    });
JS;
$this->registerJs($js);
?>
