<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/3/4
 * Time: 11:45
 * Desc:
 */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\KefuSelfservice;

$this->title = "<审核>" . $model->sn;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Selfservice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!--处理结果-->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">审核前台提交的自助服务</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?php $form = \kartik\widgets\ActiveForm::begin([
		//'type' => \kartik\form\ActiveForm::TYPE_HORIZONTAL,
	]) ?>
	<div class="box-body">
		<?= $form->field($modelCheckForm, 'result')->textarea(['rows' => 6]) ?>
		<?= $form->field($modelCheckForm, 'status')->dropDownList(KefuSelfservice::getStatus()) ?>
	</div>
	<div class="box-footer">
		<?= Html::submitButton(Yii::t('common', 'Submit'), ['class' => 'btn btn-info']) ?>
	</div>
	<?php \kartik\widgets\ActiveForm::end(); ?>
</div>


<!--详情-->
<div class="box box-info" style="margin-top: 150px;">
	<div class="box-header with-border">
		<h3 class="box-title">提交表单详情</h3>
	</div>
	<div class="kefu-selfservice-check">
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
				'sn',
				[
					'attribute' => 'category_id',
					'value' => $model->category ? $model->category->title : null,
				],
				'game_role',
				[
					'attribute' => 'game_server',
					'value' => $model->gameServer ? $model->gameServer->server_name : null,
				],
				'email:email',
				'phone',
				[
					'attribute' => 'attachments',
					'format' => 'html',
					'value' => $attachmentsImags
				],
				'content:ntext',
				[
					'attribute' => 'user_id',
					'value' => $model->user ? $model->user->username : null,
				],
				'created_at:datetime',
				'updated_at:datetime',
				'result:html',
				[
					'attribute' => 'result',
					'format' => 'html',
					'value' => "<div style='color:red;font-size:1.25em;'>" . $model->result . "</div>"
				],
			],
		]) ?>
	</div>
</div>
