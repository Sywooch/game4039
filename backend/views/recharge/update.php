<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Recharge */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
		'modelClass' => '充值',
	]) . ' ' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Recharge'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="recharge-update">

	<?php echo $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
