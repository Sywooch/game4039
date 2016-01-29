<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KefuSelfservice */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
		'modelClass' => Yii::t('common', 'Kefu Selfservice'),
	]) . ' ' . $model->sn;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Selfservice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sn, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="kefu-selfservice-update">

	<?php echo $this->render('_form', [
		'model' => $model,
		'categories' => $categories,
	]) ?>

</div>
