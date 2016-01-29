<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/30
 * Time: 16:45
 * Desc:
 */


$this->beginContent('@frontend/views/layouts/_clear.php');
?>
	<div class="wrapper">
		<!--header-->
		<?php include_once('_topbar.php') ?>

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
		<?php include_once('_singlepagefooter.php') ?>
	</div>
	<!--end wrapper-->
<?php $this->endContent() ?>