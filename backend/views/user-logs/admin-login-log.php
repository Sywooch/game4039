<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SystemLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Admin Login Log');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-log-index">

	<p>
		<?php echo Html::a(Yii::t('backend', 'Clear'), false, ['class' => 'btn btn-danger', 'data-method' => 'delete']) ?>
	</p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'id',
			[
				'attribute' => 'user_id',
			],
			'username',
			'login_ip',
			[
				'attribute' => 'login_time',
				'format' => 'datetime',
			],
			'os',
			//'category',
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}{delete}',
				'buttons'=>[
					'delete' => function ($url, $model, $key)
					{
						$url = Url::toRoute(['user-logs/delete-admin-login-log', 'id' => $key]);
						return Html::a("<span class='glyphicon glyphicon-trash'>&nbsp;</span>", $url, ['onclick' => 'confirm("你确定要删除此项吗?")']);
					}
				]
			]
		]
	]); ?>

</div>

