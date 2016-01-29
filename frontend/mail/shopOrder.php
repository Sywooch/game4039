<?php

use yii\helpers\Html;
use common\models\KefuAccountRepair;

?>

<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	<?= Yii::t('common', 'Hello') ?>,
</p>

<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	您在 <?=Yii::$app->formatter->asDatetime($shopOrder->created_at)?> 提交的订单我们已经收到,
</p>

<ul>
	<li>手机: <?= Html::encode($shopOrder->phone) ?></li>
	<li>邮箱地址: <?= Html::encode($shopOrder->email) ?></li>
</ul>

<h2>物品</h2>

<ul>
	<?php
	$sum = 0;
	foreach ($shopOrder->shopOrderItems as $item): ?>
		<?php $sum += $item->quantity * $item->price ?>
		<li><?= Html::encode($item->title . ' x ' . $item->quantity . ' x ' . $item->price . '$') ?></li>
	<?php endforeach ?>
</ul>

<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
	<?= Yii::t('common', 'If you did not make this request you can ignore this email') ?>.
</p>