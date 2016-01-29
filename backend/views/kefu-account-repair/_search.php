<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\KefuAccountRepairSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="kefu-account-repair-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'sn') ?>

    <?php echo $form->field($model, 'account') ?>

    <?php echo $form->field($model, 'reason') ?>

    <?php echo $form->field($model, 'register_time') ?>

    <?php // echo $form->field($model, 'register_place') ?>

    <?php // echo $form->field($model, 'recent_games') ?>

    <?php // echo $form->field($model, 'question_desc') ?>

    <?php // echo $form->field($model, 'bind_email') ?>

    <?php // echo $form->field($model, 'security_question_one') ?>

    <?php // echo $form->field($model, 'security_question_one_answer') ?>

    <?php // echo $form->field($model, 'security_question_two') ?>

    <?php // echo $form->field($model, 'security_question_two_answer') ?>

    <?php // echo $form->field($model, 'applicant_name') ?>

    <?php // echo $form->field($model, 'applicant_phone') ?>

    <?php // echo $form->field($model, 'applicant_identity') ?>

    <?php // echo $form->field($model, 'applicant_email') ?>

    <?php // echo $form->field($model, 'identity_front_base_url') ?>

    <?php // echo $form->field($model, 'identity_front_path') ?>

    <?php // echo $form->field($model, 'identity_back_base_url') ?>

    <?php // echo $form->field($model, 'identity_back_path') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'progress') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('common', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
