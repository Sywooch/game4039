<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KefuQq */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common', 'Kefu QQ'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu QQ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-qq-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
