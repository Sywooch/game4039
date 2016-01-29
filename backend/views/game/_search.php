<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\GameSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="game-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'category_id') ?>

    <?php echo $form->field($model, 'name') ?>

    <?php echo $form->field($model, 'description') ?>

    <?php echo $form->field($model, 'short') ?>

    <?php // echo $form->field($model, 'api_key') ?>

    <?php // echo $form->field($model, 'factory') ?>

    <?php // echo $form->field($model, 'cname') ?>

    <?php // echo $form->field($model, 'thumbnail_base_url') ?>

    <?php // echo $form->field($model, 'thumbnail_path') ?>

    <?php // echo $form->field($model, 'coin') ?>

    <?php // echo $form->field($model, 'coin_rate') ?>

    <?php // echo $form->field($model, 'game_web_url') ?>

    <?php // echo $form->field($model, 'game_bbs_url') ?>

    <?php // echo $form->field($model, 'api_secret') ?>

    <?php // echo $form->field($model, 'api_server') ?>

    <?php // echo $form->field($model, 'api_play') ?>

    <?php // echo $form->field($model, 'api_pay') ?>

    <?php // echo $form->field($model, 'api_check') ?>

    <?php // echo $form->field($model, 'api_order') ?>

    <?php // echo $form->field($model, 'q') ?>

    <?php // echo $form->field($model, 'attr') ?>

    <?php // echo $form->field($model, 'is_recommend') ?>

    <?php // echo $form->field($model, 'is_hot') ?>

    <?php // echo $form->field($model, 'is_new') ?>

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
