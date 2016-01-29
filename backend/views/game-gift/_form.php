<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\GameGift;

/* @var $this yii\web\View */
/* @var $model common\models\GameGift */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="game-gift-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

	<?= $form->field($model, 'game_server_id')->dropDownList(\yii\helpers\ArrayHelper::map($servers, 'id', 'server_name'), ['prompt' => '']) ?>

    <?php echo $form->field($model, 'lb_gid')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'lb_name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'lb_type')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'lb_method')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'lb_content')->textarea(['rows' => 6]) ?>

	<?php echo $form->field($model, 'status')->dropDownList(GameGift::getStatus()) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
