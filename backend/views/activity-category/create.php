<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ActivityCategory */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common','Activity Category'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Activity Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories' => $categories,
    ]) ?>

</div>
