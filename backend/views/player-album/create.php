<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PlayerAlbum */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => '用户相册',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Player Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-album-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
