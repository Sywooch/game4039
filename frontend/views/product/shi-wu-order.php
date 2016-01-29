<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/14
 * Time: 12:52
 * Desc:
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '4039 购物车';

//获得项目名称
$projectName = dirname(dirname(\yii\helpers\Url::base()));

//拼接backend 上传资源url
$backendUrl = \yii\helpers\Url::to($projectName . '/backend/web/', true);

//获得侧边视图地址
$aside = dirname(__DIR__) . '/aside';
?>

<?php $this->render('_breadcrumbs') ?>

	<div class="container content">
		<div class="headline"><h2>订单信息</h2></div>
		<div class="row">
			<div class="col-xs-12">
				<table class="table table-bordered">
					<tr>
						<th>名称</th>
						<th>积分</th>
					</tr>
					<tr>
						<td><?= Html::encode($shopProducts['title']) ?></td>
						<td><?= $shopProducts['jifen'] ?></td>
					</tr>
				</table>
			</div>
		</div>


		<div class="row">
			<div class="col-xs-12">
				<?php
				/* @var $form ActiveForm */
				$form = ActiveForm::begin([
					'id' => 'order-form',
				]) ?>

				<?php echo $form->errorSummary($shopOrder); ?>

				<?php echo $form->field($shopOrder, 'phone')->textInput(['maxlength' => true]) ?>

				<?php echo $form->field($shopOrder, 'email')->textInput(['maxlength' => true]) ?>

				<?php echo $form->field($shopOrder, 'address')->textarea(['rows' => 3]) ?>

				<?php echo $form->field($shopOrder, 'notes')->textarea(['rows' => 3]) ?>

				<div class="form-group row">
					<div class="col-xs-12">
						<?= Html::submitButton('提交订单', ['class' => 'btn btn-primary']) ?>
					</div>
				</div>

				<?php ActiveForm::end() ?>
			</div>
		</div>
	</div>


<?php
$js = <<<JS

//make user-nav active
$('.index-nav').removeClass('active');
$('.shangcheng-nav').addClass('active');
App.init();
JS;
$this->registerJs($js);
$this->registerCssFile('/unify/assets/css/shop.style.css');
?>