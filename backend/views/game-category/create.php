<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GameCategory */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => '游戏分类',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Game Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
