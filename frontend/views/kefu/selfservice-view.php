<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/4
 * Time: 13:48
 * Desc:
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use common\models\KefuSelfservice;
use yii\grid\GridView;
use yii\widgets\DetailView;

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
				<?php
				$attachmentsImags = '';
				foreach ($model->attachments as $ss)
				{
					$attachmentsImags .= Html::img(Yii::$app->glide->createSignedUrl([
						'glide/index',
						'path' => $ss['path'],
						'w' => 200
					], true), ['class' => 'img-responsive']);
				};
				?>
				<?php echo DetailView::widget([
					'model' => $model,
					'attributes' => [
						//'id',
						[
							'attribute' => 'category_id',
							'value' => \common\models\KefuSelfserviceCat::findOne($model->category_id)['title'],
						],
						'sn',
						'game_role',
						[
							'attribute' => 'game_server',
							'value' => \common\models\GameServer::findOne($model->game_server)['server_name'],
						],
						//'email:email',
						//'phone',
						//'user_id',
						[
							'attribute' => 'attachments',
							'format' => 'html',
							'value' => $attachmentsImags
						],
						'content:html',
						'created_at:datetime',
						//'updated_at:datetime',
						[
							'attribute' => 'status',
							'value' => ArrayHelper::getValue(KefuSelfservice::getStatus(), $model->status)
						],
						[
							'attribute' => 'result',
							'format' => 'html',
							'headerOptions' => [
								'width' => '500px'
							]
						],
					],
				]) ?>
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
