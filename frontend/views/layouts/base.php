<?php

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php');
?>
	<div class="wrapper">
		<!--header-->
		<?php include_once('_header.php') ?>

		<!--slider-->
		<?php if (isset($this->blocks['slider'])): ?>
			<?= $this->blocks['slider'] ?>
		<?php endif; ?>

		<!--breadcrumbs-->
		<?php if (isset($this->blocks['breadcrumbs'])): ?>
			<?= $this->blocks['breadcrumbs'] ?>
		<?php endif; ?>

		<!--content-->
		<?php echo $content ?>

		<!--footer-->
		<?php include_once('_footer.php') ?>
	</div>
	<!--end wrapper-->
<?php $this->endContent() ?>