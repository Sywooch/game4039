<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ShopOrder */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common','Shop Order'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Shop Order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-order-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
