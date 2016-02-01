<?php


/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common', 'Site Messages'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Site Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
