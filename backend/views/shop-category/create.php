<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ShopCategory */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common','Shop Category'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Shop Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories'=>$categories,
    ]) ?>

</div>
