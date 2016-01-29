<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KefuFaqCat */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common', 'Kefu Faq Cat'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Kefu Faq Cat'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-faq-cat-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'categories' => $categories,
    ]) ?>

</div>
