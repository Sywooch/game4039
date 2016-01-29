<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/16
 * Time: 11:25
 * Desc:
 */

namespace common\behaviors;

use common\models\AdminLoginLog;
use yii\base\Behavior;
use yii\web\User;

class LoginLogBehavior extends Behavior
{

	public function events()
	{
		return [
			User::EVENT_AFTER_LOGIN => 'afterLogin'
		];
	}

	public function afterLogin($event)
	{
		$user=$event->identity;
		$model=new AdminLoginLog();
		$model->user_id = $user->id;
		$model->username = $user->username;
		$model->login_ip = \Yii::$app->request->getUserIP();
		$model->login_time = time();
		$model->os = \Yii::$app->request->getUserAgent();
		$model->category = __METHOD__;
		$model->save(false);
	}

}