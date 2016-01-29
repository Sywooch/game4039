<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KefuSelfservice */

$this->title = Yii::t('backend', 'Create {modelClass}', [
	'modelClass' => Yii::t('common', 'Kefu Selfservice'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Selfservice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-selfservice-create">

	<?php echo $this->render('_form', [
		'model' => $model,
		'categories' => $categories,
	]) ?>

</div>
