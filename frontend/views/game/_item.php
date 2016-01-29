<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/15
 * Time: 13:27
 * Desc:
 */

use yii\helpers\Html;

?>

<!--recomend games-->

<div class="cbp-item recommend">
	<div class="cbp-caption margin-bottom-20">
		<div class="cbp-caption-defaultWrap">
			<?= Html::img(Yii::$app->glide->createSignedUrl([
				'glide/index',
				'path' => $model->thumbnail_path
			], true), ['alt' => $model->name]) ?>
		</div>
		<div class="cbp-caption-activeWrap">
			<div class="cbp-l-caption-alignCenter">
				<div class="cbp-l-caption-body">
					<ul class="link-captions no-bottom-space">
						<li><a href="">
								<button class="btn-u btn-u-xs btn-u-blue"
										type="button">
									进入游戏
								</button>
							</a></li>
						<li><a href="" class="cbp-lightbox"
							   data-title="Design Object">
								<button class="btn-u btn-u-xs btn-u-red"
										type="button">
									官网
								</button>
							</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="cbp-title-dark">
		<div class="cbp-l-grid-agency-title"><?= $model->name ?></div>
	</div>
</div>
<!--/end recommend games-->


