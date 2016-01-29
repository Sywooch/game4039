<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PlayerAlbum */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Player Album',
]) . ' ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Player Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="player-album-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
