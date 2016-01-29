<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\GameGiftSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="game-gift-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'game_id') ?>

    <?php echo $form->field($model, 'game_server_id') ?>

    <?php echo $form->field($model, 'lb_gid') ?>

    <?php echo $form->field($model, 'lb_name') ?>

    <?php // echo $form->field($model, 'lb_type') ?>

    <?php // echo $form->field($model, 'lb_method') ?>

    <?php // echo $form->field($model, 'lb_content') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
