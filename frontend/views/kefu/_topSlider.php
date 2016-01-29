<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/4
 * Time: 11:17
 * Desc:
 */

?>

<?php $this->beginBlock('slider'); ?>
<div class="breadcrumbs-v2 faq-breadcrumb margin-bottom-20">
	<div class="breadcrumbs-v2-in">
		<h1><?= $this->title ?></h1>
	</div>
</div>
<?php $this->endBlock(); ?>



<?php
$css = <<<CSS
.breadcrumbs-v2 {
    text-align: center;
    position: relative;
    background: url(/img/kefuzhongxing-bg.jpg) no-repeat center;
    height: 300px;
}

.service-block a {
    color: #fff;
}

CSS;
$this->registerCss($css);


$js = <<<JS
jQuery(document).ready(function() {
//make user-nav active
$('.index-nav').removeClass('active');
$('.kefu-nav').addClass('active');

    });
JS;
$this->registerJs($js);
?>
