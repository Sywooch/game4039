<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ShopProductSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="shop-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'title') ?>

    <?php echo $form->field($model, 'slug') ?>

    <?php echo $form->field($model, 'description') ?>

    <?php echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'jifen') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'thumbnail_base_url') ?>

    <?php // echo $form->field($model, 'thumbnail_path') ?>

    <?php // echo $form->field($model, 'img_base_url') ?>

    <?php // echo $form->field($model, 'img_path') ?>

    <?php // echo $form->field($model, 'product_number') ?>

    <?php // echo $form->field($model, 'return_jifen') ?>

    <?php // echo $form->field($model, 'is_on_sale') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <?php // echo $form->field($model, 'is_hot') ?>

    <?php // echo $form->field($model, 'is_promote') ?>

    <?php // echo $form->field($model, 'is_check') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
