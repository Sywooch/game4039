<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SecurityQuestions */

$this->title = Yii::t('backend', 'Create {modelClass}', [
	'modelClass' => Yii::t('common', 'Security Questions'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Security Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="security-questions-create">

	<?php echo $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
