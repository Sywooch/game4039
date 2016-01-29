<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 * @var $model common\models\TimelineEvent
 */
?>
<div class="timeline-item">
    <span class="time">
        <i class="fa fa-clock-o"></i>
        <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>

    <h3 class="timeline-header">
        <?php echo Yii::t('common', 'an admin user was deleted!') ?>
    </h3>

    <div class="timeline-body">
        <?php echo Yii::t('common', '{delete_time} : admin ({identity}) was deleted by {by_user}', [
            'identity' => $model->data['public_identity'],
			'by_user' => $model->data['by_user'],
            'delete_time' => Yii::$app->formatter->asDatetime($model->data['delete_time'])
        ]) ?>
    </div>
</div>