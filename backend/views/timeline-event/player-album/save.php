<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/14
 * Time: 17:36
 * Desc:
 */
?>
<div class="timeline-item">
    <span class="time">
        <i class="fa fa-clock-o"></i>
		<?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>

	<h3 class="timeline-header">
		<?php echo Yii::t('common', 'a new user album was created!') ?>
	</h3>

	<div class="timeline-body text-primary">
		<?php echo Yii::t('common', '{created_time} : {created_by} created a new user album', [
			'created_time' => Yii::$app->formatter->asDatetime($model->data['created_time']),
			'created_by' => $model->data['created_by'],
		]) ?>
	</div>

	<div class="timeline-footer">
		<?php echo \yii\helpers\Html::a(
			Yii::t('backend', 'View Detail'),
			['/player-album/view', 'id' => $model->data['model_id']],
			['class' => 'btn btn-warning btn-sm btn-flat']
		) ?>
	</div>
</div>