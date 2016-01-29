<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/24
 * Time: 14:52
 * Desc: 获取ucenter接口函数
 */

namespace common\util;


class UcenterInterface
{
	private static $_instance = null;

	//私有构造函数,防止外界实例化该对象
	private function __construct()
	{
		include_once \Yii::getAlias('@ucenter');
	}

	//私有化克隆函数,防止外界克隆该对象
	private function __clone()
	{
	}

	public static function getInstance()
	{
		if (is_null(self::$_instance) || isset(self::$_instance))
		{
			self::$_instance = new UcenterInterface();
		}
		return self::$_instance;
	}

	public function getName()
	{
		return 'getUcenterInterface';
	}

}