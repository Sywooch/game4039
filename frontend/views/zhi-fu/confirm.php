<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/26
 * Time: 13:54
 * Desc:
 */
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use common\models\Recharge;

$this->title = '充值';

//myVarDump($model);

?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">充值中心</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/site/index') ?>">首页</a></li>
			<li class="active">充值中心</li>
		</ul>
	</div>
</div>
<?php $this->endBlock(); ?>

<div class="container content">
	<div class="row">
		<div class="col-md-12">
			<div class="headline"><h3 class="heading-sm">确认充值信息</h3></div>
			<?php echo DetailView::widget([
				'model' => $model,
				'attributes' => [
					'user_id',
					[
						'attribute' => 'game_id',
						'value' => \common\models\Game::findOne($model->game_id)['name'],
					],
					[
						'attribute' => 'server_id',
						'value' => \common\models\GameServer::findOne($model->server_id)['server_name'],
					],
					'pay_mode',
					[
						'attribute' => 'amount',
						'value' => $model->amount . '元',
					],
					[
						'attribute' => '获得元宝数量',
						'value' => ($model->amount * 10) . '元宝',
					],
				],
			]) ?>
			<?php $form = \kartik\form\ActiveForm::begin([
				'type' => \kartik\form\ActiveForm::TYPE_HORIZONTAL,
			]) ?>

			<?= $form->field($model, 'user_id')->textInput([
				'value' => Yii::$app->user->identity->username,
				'readonly' => 'readonly',
			]) ?>

			<?= $form->field($model, 'game_id')->dropDownList(ArrayHelper::map(\common\models\Game::find()->statusInUse()->all(), 'id', 'name'), ['prompt' => '',]) ?>

			<?= $form->field($model, 'server_id')->dropDownList(ArrayHelper::map(\common\models\GameServer::find()->statusInUse()->all(), 'id', 'server_name'), ['prompt' => '',]) ?>

			<?= $form->field($model, 'pay_mode')->dropDownList(Recharge::getPayMode(), ['prompt' => '',]) ?>

			<?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

			<div class="form-group text-center">
				<?= Html::submitButton('确认提交', ['class' => 'btn btn-success']) ?>
				<?= Html::submitButton('取消', ['class' => 'btn btn-success']) ?>
			</div>

			<?php \kartik\form\ActiveForm::end(); ?>
		</div>

	</div>
</div>


<?php
$js = <<<JS
	$('.index-nav').removeClass('active');
	$('.chongzhi-nav').addClass('active');
    App.init();

JS;
$this->registerJs($js);
?>
