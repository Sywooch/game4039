<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ActivityCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common','Activity Category'),
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Activity Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="activity-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories' => $categories,
    ]) ?>

</div>
