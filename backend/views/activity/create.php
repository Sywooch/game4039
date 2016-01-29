<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Activity */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common','Activity'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Activity'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories' => $categories,
    ]) ?>

</div>
