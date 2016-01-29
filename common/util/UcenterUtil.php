<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/24
 * Time: 17:07
 * Desc:
 */

namespace common\util;


class UcenterUtil
{

	/**
	 * 通过用户名获得ucenter的用户,返回的的ararry结构为0->id,1->username,2->email
	 * @param $username
	 * @return array|mixed|string
	 */
	public static function getUser($username)
	{
		UcenterInterface::getInstance();
		return uc_get_user($username);
	}

	/**
	 * 同步登陆ucenter
	 * @param $event
	 */
	public static function syncLogin($event)
	{
		UcenterInterface::getInstance();
		$user = $event->identity;
		$ucenterUser = self::getUser($user->username);

		//同步登陆ucenter
		setcookie('Example_auth', '', -86400);
		setcookie('Example_auth', uc_authcode($ucenterUser[0] . "\t" . $ucenterUser[1], 'ENCODE'));
		$ucsynlogin = uc_user_synlogin($ucenterUser[0]);

		//生成同步登录的代码
		$script = '登录成功' . $ucsynlogin . '<br><a href="' . $_SERVER['PHP_SELF'] . '">继续</a>';
		\Yii::$app->session->setFlash('syn-login-script', "$script");
	}

	/**
	 * 同步注册到ucenter
	 * @param $username
	 * @param $password
	 * @param $email
	 * @return mixed
	 */
	public static function register($username, $password, $email)
	{
		UcenterInterface::getInstance();
		$uid = uc_user_register($username, $password, $email);
		return $uid;
	}

	/**
	 * 同步退出ucenter
	 */
	public static function logout()
	{
		UcenterInterface::getInstance();
		$script = uc_user_synlogout();
		\Yii::$app->session->setFlash('syn-logout-script', "$script");
	}


	/**
	 * 更新用户资料ucenter
	 * @param $username
	 * @param $oldpw
	 * @param $newpw
	 * @param $email
	 * @return mixed
	 */
	public static function userEditWithoutEmail($username, $oldpw, $newpw, $email)
	{
		UcenterInterface::getInstance();
		return uc_user_edit($username, $oldpw, $newpw, $email = '');
	}

	public static function userEditEmail($username, $email)
	{
		UcenterInterface::getInstance();
		return uc_user_edit($username, '', '', $email, $ignoreoldpw = 1);
	}


	/**
	 * 修改用户头像ucenter
	 * @param $user
	 * @return array|string
	 */
	public static function ucAvatar($user)
	{
		UcenterInterface::getInstance();
		$ucUser = self::getUser($user->username);
		return uc_avatar($ucUser[0], 'virtual');
	}


	/**
	 * 获得用户头像的url
	 * @param $user
	 * @return string
	 */
	public static function  getUserAvatar($user)
	{
		/*<?= Yii::getAlias('@ucServer') . 'avatar.php?uid=' . $ucUser[0] . '&type=virtual&size=middle' ?>*/
		UcenterInterface::getInstance();
		$ucUser = self::getUser($user->username);
		return \Yii::getAlias('@ucServer') . 'avatar.php?uid=' . $ucUser[0] . '&type=virtual&size=big';
	}


	/**
	 * 删除ucenter中的用户,根据用户id
	 * @param $uid
	 * @return mixed
	 */
	public static function ucUserDelete($uid)
	{
		UcenterInterface::getInstance();
		return uc_user_delete($uid);
	}
}