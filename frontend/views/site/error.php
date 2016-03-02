<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Url;

//myVarDump(mb_strlen($message));
$this->title = mb_substr($message, 0, mb_strlen($message, 'utf-8') - 1, 'utf-8');

//myVarDump($exception);
?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left"><?php echo Html::encode($this->title) ?></h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/site/index') ?>">首页</a></li>
			<li class="active"><?php echo Html::encode($this->title) ?></li>
		</ul>
	</div>
</div>
<?php $this->endBlock(); ?>

<div class="container content">
	<!--Error Block-->
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="error-v1">
				<span class="error-v1-title"><?= $exception->statusCode ?></span>

				<p><?= $this->title ?></p>
				<a class="btn-u btn-bordered" href="<?= Url::to('/site/index') ?>">返回首页</a>
			</div>
		</div>
	</div>
	<!--End Error Block-->
</div>

<?php
$css = <<<CSS
/*404 Error Page v1
------------------------------------*/
.error-v1 {
	padding-bottom: 30px;
	text-align: center;
}
.error-v1 p {
	color: #555;
	font-size: 16px;
}
.error-v1 span {
	color: #555;
	display: block;
	font-size: 35px;
	font-weight: 200;
}

.error-v1 span.error-v1-title {
	color: #777;
	font-size: 180px;
	line-height: 200px;
	padding-bottom: 20px;
}

/*For Mobile Devices*/
@media (max-width: 500px) {
	.error-v1 p {
		font-size: 12px;
	}
	.error-v1 span {
		font-size: 25px;
	}
	.error-v1 span.error-v1-title {
		font-size: 140px;
	}
}
CSS;

$this->registerCss($css);

?>

