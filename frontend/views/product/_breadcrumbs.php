<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/13
 * Time: 11:31
 * Desc:
 */
use yii\helpers\Url;

?>



<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs-v4">
	<div class="container">

		<h1>积分商城</h1>
		<ul class="breadcrumb-v4-in">
			<li><a href="<?= Url::to(['/site/index']) ?>">首页</a></li>
			<li class="active">积分商城</li>
		</ul>
	</div>
	<!--/end container-->
</div>
<?php $this->endBlock(); ?>
