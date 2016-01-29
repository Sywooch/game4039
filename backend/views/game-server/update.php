<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GameServer */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common','Game Server'),
]) . ' ' . $model->server_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Game Server'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->server_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="game-server-update">

    <?php echo $this->render('_form', [
        'model' => $model,
		'games'=>$games,
    ]) ?>

</div>
