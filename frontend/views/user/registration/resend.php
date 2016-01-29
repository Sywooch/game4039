<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/*
 * @var yii\web\View                    $this
 * @var dektrium\user\models\ResendForm $model
 */


$this->title = Yii::t('user', 'Request new confirmation message');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('breadcrumbs'); ?>
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">确认消息</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::to('/site/index') ?>">首页</a></li>
			<li class="active">确认消息</li>
		</ul>
	</div>
	<!--/container-->
</div>
<?php $this->endBlock(); ?>

<div class="container content">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
				</div>
				<div class="panel-body">
					<?php $form = ActiveForm::begin([
						'id'                     => 'resend-form',
						'enableAjaxValidation'   => true,
						'enableClientValidation' => false,
					]); ?>

					<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

					<?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'btn btn-primary btn-block']) ?><br>

					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

