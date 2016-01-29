<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\IndexSlide */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common','Index Slide'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Index Slide'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-slide-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
