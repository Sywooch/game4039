<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/15
 * Time: 15:31
 * Desc:
 */

use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use common\models\Recharge;

use kartik\checkbox\CheckboxX;

$this->title = "充值";

$gameList1 = [0 => '请选择游戏...'];
$gameList2 = ArrayHelper::map(\common\models\Game::find()->statusInUse()->all(), 'id', 'name');
$gameList = ArrayHelper::merge($gameList1, $gameList2);

//(new \common\models\BeeClound(\common\models\BeeClound::CHANNEL_ALI_WEB,'ceshi	',1,[]))->bill();
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
		<!-- Begin Sidebar Menu -->
		<div class="col-md-2">
			<?= $this->render('_leftMenu') ?>
		</div>
		<!-- End Sidebar Menu -->

		<!-- Begin Content -->
		<div class="col-md-110">
			<!--支付宝-->
			<div class="headline"><h3 class="heading-sm">支付宝</h3></div>
			<?php $form = \kartik\form\ActiveForm::begin([
				'type' => \kartik\form\ActiveForm::TYPE_INLINE,
				'id' => $model->formName(),
			]) ?>

			<?= $form->field($model, 'user_id')->textInput([
				'value' => Yii::$app->user->identity->username,
				'readonly' => 'readonly',
			]) ?>
			<?php echo $form->field($model, 'game_id')->dropDownList($gameList, ['id' => 'game_id']); ?>

			<?php echo $form->field($model, 'server_id')->widget(\kartik\widgets\DepDrop::classname(), [
				'options' => ['id' => 'server_id'],
				'pluginOptions' => [
					'depends' => ['game_id'],
					'placeholder' => '请选择...',
					'url' => Url::to(['/zhi-fu/get-server'])
				]
			]); ?>

			<?= $form->field($model, 'pay_mode')->dropDownList(Recharge::getPayMode(), ['prompt' => '请选择充值方式',]) ?>

			<?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

			<div class="form-group text-center">
				<?= Html::submitButton('立即充值', ['class' => 'btn btn-success']) ?>
			</div>
			<?php \kartik\form\ActiveForm::end(); ?>

		</div>
		<!-- End Content -->
	</div>
</div>
<?php

$js = <<<JS
	$('.index-nav').removeClass('active');
	$('.chongzhi-nav').addClass('active');
    App.init();

    $('form#{$model->formName()}').on('beforeSubmit', function(e) {
   var \$form = $(this);
   var user_id=\$form.find('input#rechargeform-user_id').val();
   var amount=\$form.find('input#rechargeform-amount').val();
   var game_text=\$form.find('select#game_id').find('option:selected').text();
   var game_server_text=\$form.find('select#server_id').find('option:selected').text();
   var yuan_bao=amount*10;
	layer.confirm(
	"请确认您的充值信息正确<br>"+
	'充值账号:'+user_id+'<br>'+
	'您所指定的游戏:'+game_text+' '+game_server_text+'<br>'+
	'您的充值金额:'+amount+'元<br>'+
	'您将获得元宝数量:'+yuan_bao+'元宝<br>',
	 {
		btn: ['确认提交','返回修改'] //按钮
	}, function(){
		$.ajax({
        url:\$form.attr('action'),
        type:'post',
        data:\$form.serialize(),
        success:function(data){
            console.log(data);
            var obj=$.parseJSON(data);
            if(obj.status == 1){
                //登录成功重载当前页面
                location.reload();
            }
            if(obj.status == 0){
            }
        }
   });
	}, function(){
	});

}).on('submit', function(e){
    e.preventDefault();
});

JS;
$this->registerJs($js);
?>
