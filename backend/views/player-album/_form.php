<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use trntv\filekit\widget\Upload;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\PlayerAlbum */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="player-album-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\dektrium\user\models\User::find()->all(),'id','username'),['prompt' => '']) ?>

    <?php echo $form->field($model, 'thumbnail')->widget(
        Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 5000000, // 5 MiB
        ]);
    ?>

    <?php echo $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
