<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FriendsLinks */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common', 'Friends Links'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Friends Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friends-links-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
