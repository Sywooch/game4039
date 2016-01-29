<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/13
 * Time: 11:34
 * Desc:
 */

use common\models\ShopCategory;
use yii\helpers\Html;
use common\util\Buuug7Util;

?>

<h1>筛选</h1>

<div class="panel-group" id="accordion-v2">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion-v2" href="#collapseTwo">
					按照分类
					<i class="fa fa-angle-down"></i>
				</a>
			</h2>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse in">
			<div class="panel-body">
				<ul class="list-unstyled checkbox-list">
					<?php foreach (ShopCategory::find()->all() as $sc): ?>
						<li>
							<label class="checkbox">
								<input type="checkbox" name="checkbox" checked="">
								<i></i>
								<?= Html::a($sc->title, ['list', 'ShopProductSearch[category_id]' => $sc->id]) ?>
								<small><?= Buuug7Util::getOnSaleProductCount($sc->id)?></small>
							</label>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--/end panel group-->

<div class="panel-group" id="accordion-v4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion-v4" href="#collapseFour">
					按照积分
					<i class="fa fa-angle-down"></i>
				</a>
			</h2>
		</div>
		<div id="collapseFour" class="panel-collapse collapse in">
			<div class="panel-body">
				<ul class="list-unstyled checkbox-list">
					<a href="#">全部</a><span style="width: 20px;"></span><br/>
					<a href="#">0-100</a><span style="width: 20px;"></span>
					<a href="#">101-1000</a><span style="width: 20px;"></span><br/>
					<a href="#">1001-5000</a><span style="width: 20px;"></span>
					<a href="#">5001-10000</a><span style="width: 20px;"></span><br/>
					<a href="#">10000+</a><span style="width: 20px;"></span>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--/end panel group-->
