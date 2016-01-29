<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KefuQq */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common', 'Kefu QQ'),
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu QQ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="kefu-qq-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
