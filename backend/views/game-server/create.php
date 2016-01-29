<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GameServer */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common','Game Server'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Game Server'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-server-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'games'=>$games,
    ]) ?>

</div>
