<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */


\yii\base\Event::on(\yii\web\User::className(), \yii\web\User::EVENT_AFTER_LOGIN, function ($event)
{
	//同步登陆ucenter
	\common\util\UcenterUtil::syncLogin($event);

	//记录前台登陆日志
	$user = $event->identity;
	$model = new \common\models\UserLoginLog();
	$model->user_id = $user->id;
	$model->username = $user->username;
	$model->login_ip = \Yii::$app->request->getUserIP();
	$model->login_time = time();
	$model->os = \Yii::$app->request->getUserAgent();
	$model->category = __METHOD__;
	$model->save(false);
});

//同步退出ucenter
\yii\base\Event::on(\yii\web\User::className(), \yii\web\User::EVENT_AFTER_LOGOUT, function ($event)
{
	\common\util\UcenterUtil::logout();
});

//同步删除ucenter的用户
\yii\base\Event::on(\dektrium\user\models\User::className(), \dektrium\user\models\User::EVENT_AFTER_DELETE, function ($event)
{
	$ucUser = \common\util\UcenterUtil::getUser($event->sender->username);
	\common\util\UcenterUtil::ucUserDelete($ucUser[0]);

	//删除discuz中common_member中用户信息
	$dzHelper = new \common\util\DzHelper();
	$dzHelper->deleteDzUserByUsername($ucUser[1]);
});