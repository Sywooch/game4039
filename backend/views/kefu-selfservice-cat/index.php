<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\KefuSelfserviceCatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Kefu Selfservice Cat');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kefu-selfservice-cat-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('common', 'Kefu Selfservice Cat'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parent_id',
            'title',
            'slug',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
