<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShopOrder */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common', 'Shop Order'),
]) . ' ' . $model->order_sn;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Shop Order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_sn, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="shop-order-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
