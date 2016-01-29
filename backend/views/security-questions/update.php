<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SecurityQuestions */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common', 'Security Questions'),
]) . ' ' . $model->question;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Security Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->question, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="security-questions-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
