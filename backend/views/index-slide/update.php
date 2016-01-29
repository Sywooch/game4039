<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IndexSlide */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common', 'Index Slide'),
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Index Slide'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="index-slide-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
