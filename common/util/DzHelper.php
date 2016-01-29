<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/25
 * Time: 18:12
 * Desc:
 */

namespace common\util;


use yii\base\Model;
use yii\db\Query;

class DzHelper
{

	/*
	 * 数据表为pre_common_member
	 * 在dz中登陆后用$_G['member']['credits']可以访问用户
	 * */

	/**
	 * @var
	 */
	public $db;
	/**
	 * @var
	 */
	public $query;

	/**
	 *
	 */
	function __construct()
	{
		$this->db = \Yii::$app->dzdb;
		$this->query = new Query();
	}


	/**
	 * 通过用户名获取discuz论坛用户信息
	 * @param $username
	 */
	public function getDzUserByUsername($username)
	{
		return $this->query->from('{{%common_member}}')->where(['username' => $username])->one($this->db);
	}

	/**
	 * 删除discuz的用户
	 * @param $username
	 */
	public function deleteDzUserByUsername($username)
	{
		// DELETE
		$sql = $this->db->createCommand()->delete('{{%common_member}}', ['username' => $username] )->execute();
	}

}