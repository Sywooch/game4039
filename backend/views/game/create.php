<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Game */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => '游戏',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Games'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories'=>$categories,
    ]) ?>

</div>
