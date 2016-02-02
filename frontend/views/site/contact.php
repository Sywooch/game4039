<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = '联系我们';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">联系我们</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/site/index') ?>">首页</a></li>
			<li class="active">联系我们</li>
		</ul>
	</div>
	<!--/container-->
</div>
<?php $this->endBlock(); ?>

<div class="container content">
	<div class="site-contact">
		<h1><?php echo Html::encode($this->title) ?></h1>

		<div class="row">
			<div class="col-lg-5">
				<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
				<?php echo $form->field($model, 'name') ?>
				<?php echo $form->field($model, 'email') ?>
				<?php echo $form->field($model, 'subject') ?>
				<?php echo $form->field($model, 'body')->textArea(['rows' => 6]) ?>
				<?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
					'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
				]) ?>
				<div class="form-group">
					<?php echo Html::submitButton(Yii::t('frontend', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>

	</div>
</div>
