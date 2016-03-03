<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/3/3
 * Time: 13:40
 * Desc:
 */
?>

<div class="timeline-item">
    <span class="time">
        <i class="fa fa-clock-o"></i>
		<?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>

	<h3 class="timeline-header">
		<?php if ($model->data['method'] === 'insert'): ?>
			<?= Yii::t('common', 'a new game server ({model_name}) was created!', ['model_name' => $model->data['model_name']]) ?>
		<?php else: ?>
			<?= Yii::t('common', 'game server ({model_name}) was updated!', ['model_name' => $model->data['model_name']]) ?>
		<?php endif; ?>
	</h3>

	<div class="timeline-body text-primary">
		<?php if ($model->data['method'] === 'insert'): ?>
			<?php echo Yii::t('common', '{created_time} : {created_by} created a new game server ({model_name})', [
				'created_time' => Yii::$app->formatter->asDatetime($model->data['created_time']),
				'created_by' => $model->data['created_by'],
				'model_name' => $model->data['model_name'],
			]) ?>
		<?php else: ?>
			<?php echo Yii::t('common', '{created_time} : {created_by} game server ({model_name}) was updated', [
				'created_time' => Yii::$app->formatter->asDatetime($model->data['created_time']),
				'created_by' => $model->data['created_by'],
				'model_name' => $model->data['model_name'],
			]) ?>
		<?php endif; ?>
	</div>

	<div class="timeline-footer">
		<?php echo \yii\helpers\Html::a(
			Yii::t('backend', 'View Detail'),
			['/game-server/view', 'id' => $model->data['model_id']],
			['class' => 'btn btn-warning btn-sm btn-flat']
		) ?>
	</div>
</div>
