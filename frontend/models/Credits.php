<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/2/2
 * Time: 18:30
 * Desc:
 */

namespace frontend\models;


use yii\base\Model;

class Credits extends Model
{

	const  VIP0 = 'VIP0';
	const  VIP1 = 'VIP1';
	const  VIP2 = 'VIP2';
	public $keyStoryge = null;


	public function __construct($config = [])
	{
		$this->keyStoryge = \Yii::$app->keyStorage;

	}

	/**
	 * 通过用户的积分返回对应的vip详情
	 * @param $credit
	 * @return array
	 */
	public function getUserVipLevelByCredit($credit)
	{
		$result = array();
		//vip 0
		if ($credit < $this->keyStoryge->get('VIP0'))
		{
			$result['vip-level'] = self::VIP0;
			$result['next-level'] = self::VIP1;
			$result['next-credits'] = $this->keyStoryge->get(self::VIP0);
			$result['need-credits'] = $this->keyStoryge->get(self::VIP0) - $credit;
			$result['current-credits'] = $credit;
			$result['current-percent'] = $credit / $this->keyStoryge->get(self::VIP0) * 100;
			$result['next-level-info'] = $result['current-credits'] . ' / ' . $result['next-credits'] . ' (' . $result['next-level'] . ')';
			return $result;
		}
		//vip 1
		if ($credit < $this->keyStorage->get('VIP1'))
		{
			$result['vip-level'] = self::VIP1;
			$result['next-level'] = self::VIP2;
			$result['next-credits'] = $this->keyStoryge->get(self::VIP1);
			$result['need-credits'] = $this->keyStoryge->get(self::VIP1) - $credit;
			$result['current-credits'] = $credit;
			$result['current-percent'] = $credit / $this->keyStoryge->get(self::VIP0) * 100;
			$result['next-level-info'] = $result['current-credits'] . ' / ' . $result['next-credits'] . ' (' . $result['next-level'] . ')';
			return $result;
		}
		//vip >1
		if ($credit > $this->keyStorage->get('VIP1'))
		{
			$result['vip-level'] = self::VIP2;
			$result['next-level'] = self::VIP2;
			$result['next-credits'] = $this->keyStoryge->get(self::VIP2);
			$result['need-credits'] = $this->keyStoryge->get(self::VIP2) - $credit;
			$result['current-credits'] = $credit;
			$result['current-percent'] = $credit / $this->keyStoryge->get(self::VIP0) * 100;
			$result['next-level-info'] = $result['current-credits'] . ' / ' . $result['next-credits'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

	}

}