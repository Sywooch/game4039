<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ShopProduct */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common', 'Shop Product'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Shop Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-product-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories' => $categories,
    ]) ?>

</div>
