<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GameGift */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common','Game Gift'),
]) . ' ' . $model->lb_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Game Gift'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lb_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="game-gift-update">

    <?php echo $this->render('_form', [
        'model' => $model,
		'servers' => $servers,
    ]) ?>

</div>
