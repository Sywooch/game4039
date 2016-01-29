<?php
/* @var $this \yii\web\View */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $content string */

$this->beginContent('@frontend/views/layouts/base.php')
?>
<div class="">
	<?php if (Yii::$app->session->hasFlash('alert')): ?>
		<?php echo \yii\bootstrap\Alert::widget([
			'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
			'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
		]) ?>
	<?php endif; ?>

	<?php echo $content ?>
	<!--输出同步登陆脚本,设置为隐藏-->
	<?= Html::tag('div', Yii::$app->session->getFlash('syn-login-script'), ['style' => 'display:none']) ?>
	<?= Html::tag('div', Yii::$app->session->getFlash('syn-logout-script'), ['style' => 'display:none']) ?>

</div>
<?php $this->endContent() ?>


