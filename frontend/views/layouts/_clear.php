<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>

<!--[if IE 8]>
<html lang="<?= Yii::$app->language ?>" class="ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="<?= Yii::$app->language ?>" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= Yii::$app->language ?>"> <!--<![endif]-->

<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $this->title; ?> | <?= Yii::$app->keyStorage->get('seo_title') ?></title>
	<meta name="keywords" content="<?= Yii::$app->keyStorage->get('seo_keywords') ?>">
	<meta name="description" content="<?= Yii::$app->keyStorage->get('seo_description') ?>">
	<?php $this->head() ?>
	<?= Html::csrfMetaTags() ?>
</head>
<!--盒子模型-->
<!--<body class="boxed-layout container">-->
<body class="">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
