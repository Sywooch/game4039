<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KefuAccountRepair */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
		'modelClass' => Yii::t('common', 'Kefu Account Repair'),
	]) . ' ' . $model->sn;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Account Repair'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sn, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="kefu-account-repair-update">

	<?php echo $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
