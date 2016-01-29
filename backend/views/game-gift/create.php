<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GameGift */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common','Game Gift'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Game Gift'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-gift-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'servers' => $servers,
    ]) ?>

</div>
