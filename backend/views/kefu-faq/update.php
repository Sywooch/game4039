<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KefuFaq */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('common', 'Kefu Faq'),
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Faq'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="kefu-faq-update">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories' => $categories,
    ]) ?>

</div>
