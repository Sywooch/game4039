<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\KefuSelfserviceCatSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="kefu-selfservice-cat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'parent_id') ?>

    <?php echo $form->field($model, 'title') ?>

    <?php echo $form->field($model, 'slug') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('common', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
