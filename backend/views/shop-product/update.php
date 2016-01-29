<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShopProduct */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common', 'Shop Product'),
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Shop Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="shop-product-update">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories' => $categories,
    ]) ?>

</div>
