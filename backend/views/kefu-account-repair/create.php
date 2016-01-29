<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KefuAccountRepair */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common', 'Kefu Account Repair'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Account Repair'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-account-repair-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
