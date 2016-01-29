<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KefuSelfserviceCat */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common', 'Kefu Selfservice Cat'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Selfservice Cat'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-selfservice-cat-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories' => $categories,
    ]) ?>

</div>
