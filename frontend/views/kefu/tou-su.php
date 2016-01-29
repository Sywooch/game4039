<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/4
 * Time: 11:57
 * Desc:
 */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = '自助服务 | 投诉';
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

				<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

				<?= $form->field($model, 'category_id')->hiddenInput(['value' => $cat['id']])->label(false) ?>
				<?= $form->field($model, 'game_server')->dropDownList(ArrayHelper::map(\common\models\GameServer::find()->all(), 'id', 'server_name'), ['prompt' => '请选择服务器']) ?>
				<?= $form->field($model, 'game_role') ?>
				<?= $form->field($model, 'email') ?>
				<?= $form->field($model, 'phone') ?>
				<?php echo $form->field($model, 'attachments')->widget(
					\trntv\filekit\widget\Upload::className(),
					[
						'url' => ['/file-storage/upload'],
						'sortable' => true,
						'maxFileSize' => 10000000, // 10 MiB
						'maxNumberOfFiles' => 5
					]);
				?>
				<?= $form->field($model, 'content')->textarea(['rows' => 6,]) ?>

				<div class="form-group">
					<div class="">
						<?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
					</div>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>


<?php

$js = <<<JS
jQuery(document).ready(function() {

$('.tou-su').addClass('active');

    });
JS;
$this->registerJs($js);
?>
