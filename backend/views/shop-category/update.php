<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShopCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common','Shop Category'),
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Shop Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="shop-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories'=>$categories,
    ]) ?>

</div>
