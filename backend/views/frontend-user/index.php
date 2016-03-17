<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/3/17
 * Time: 9:46
 * Desc:
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\jui\DatePicker;

$this->title = Yii::t('common', 'Frontend User');
$this->params['breadcrumbs'][] = $this->title;
?>

<?=GridView::widget([
	'dataProvider' 	=> $dataProvider,
	'filterModel'  	=> $searchModel,
	'layout' => "{items}\n{summary}\n{pager}",
	'columns' => [
		[
			'header' => Yii::t('common','Username'),
		    'attribute'=>'username',
		],
		[
			'header' => Yii::t('common', 'Email'),
		    'attribute'=>'email',
		    'format' => 'email',
		],
		[
			'header' => Yii::t('common', 'Registration ip'),
			'attribute' => 'registration_ip',
			'value' => function ($model) {
				return $model->registration_ip == null
					? '<span class="not-set">' . Yii::t('user', '(not set)') . '</span>'
					: $model->registration_ip;
			},
			'format' => 'html',
		],
		[
			'header' => Yii::t('common', 'Registration time'),
			'attribute' => 'created_at',
			'format' => 'datetime',
			'filter' => DatePicker::widget([
				'model'      => $searchModel,
				'attribute'  => 'created_at',
				'dateFormat' => 'php:Y-m-d',
				'options' => [
					'class' => 'form-control',
				],
			]),
		],
		[
			'header' => Yii::t('common', 'Confirmation'),
			'value' => function ($model) {
				if ($model->isConfirmed) {
					return '<div class="text-center"><span class="text-success">' . Yii::t('common', 'Confirmed') . '</span></div>';
				} else {
					return Html::a(Yii::t('common', 'Confirm'), ['confirm', 'id' => $model->id], [
						'class' => 'btn btn-xs btn-success btn-block confirm',
						'data-method' => 'post',
						'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?'),
					]);
				}
			},
			'format' => 'raw'
		],
		[
			'header' => Yii::t('common', 'Block status'),
			'value' => function ($model) {
				if ($model->isBlocked) {
					return Html::a(Yii::t('common', 'Unblock'), ['block', 'id' => $model->id], [
						'class' => 'btn btn-xs btn-success btn-block block-status',
						'data-method' => 'post',
						//'data-confirm' => Yii::t('user', 'Are you sure you want to unblock this user?'),
					]);
				} else {
					return Html::a(Yii::t('common', 'Block'), ['block', 'id' => $model->id], [
						'class' => 'btn btn-xs btn-danger btn-block block-status',
						'data-method' => 'post',
						//'data-confirm' => Yii::t('user', 'Are you sure you want to block this user?'),
					]);
				}
			},
			'format' => 'raw',
		],
		[
			'class' => 'yii\grid\ActionColumn',
			'template' => '',
		],
	],
]); ?>

<?php
$js=<<<JS
$("a.block-status,a.confirm").on("click",function(e){
	return false;
});
JS;
$this->registerJs($js);

