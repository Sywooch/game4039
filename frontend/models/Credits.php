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


	/**
	 * vip等级常量的定义
	 */
	const  VIP0 = 'VIP0';
	const  VIP1 = 'VIP1';
	const  VIP2 = 'VIP2';
	const  VIP3 = 'VIP3';
	const  VIP4 = 'VIP4';
	const  VIP5 = 'VIP5';
	const  VIP6 = 'VIP6';
	const  VIP7 = 'VIP7';
	const  VIP8 = 'VIP8';
	const  VIP9 = 'VIP9';


	/**
	 * keyStorage 键值对对象
	 * @var mixed|null
	 */
	public $keyStoryge = null;


	/**
	 * 论坛积分跟成长值兑换比例,默认为1:1
	 * @var int
	 */
	public $creditsGrowthValueRate = 1;


	public function __construct($config = [])
	{
		$this->keyStoryge = \Yii::$app->keyStorage;
		$this->creditsGrowthValueRate = \Yii::$app->keyStorage->get('credits-growth-value-rate');
	}

	/**
	 * 通过vip等级获得对应等级的成长值上下限,0=>min,1=>max
	 * @param $vipLevel
	 * @return array
	 */
	public function getMaxMinGrowthByVipLevel($vipLevel)
	{
		$temp = explode(',', $this->keyStoryge->get($vipLevel));
		$result['min'] = $temp[0];
		$result['max'] = $temp[1];
		return $result;
	}

	/**
	 * 通过用户的积分返回成长值
	 * @param $credits
	 * @return int
	 */
	public function getUserGrowthValueByCredits($credits)
	{
		return $this->creditsGrowthValueRate * $credits;
	}

	/**
	 * 通过用户的积分返回对应的vip详情
	 * @param $credit
	 * @return array
	 */
	public function getUserVipLevelByCredit($credits)
	{
		$result = array();
		$growthValue = $this->getUserGrowthValueByCredits($credits);

		//vip 0
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP0)['min'] && $growthValue < $this->getMaxMinGrowthByVipLevel(self::VIP0)['max'])
		{
			$currentLevelLable = self::VIP0;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP1;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'] - $growthValue;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $growthValue;//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

		//vip 1
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP1)['min'] && $growthValue < $this->getMaxMinGrowthByVipLevel(self::VIP1)['max'])
		{
			$currentLevelLable = self::VIP1;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP2;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'] - $growthValue;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $growthValue;//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

		//vip 2
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP2)['min'] && $growthValue < $this->getMaxMinGrowthByVipLevel(self::VIP2)['max'])
		{
			$currentLevelLable = self::VIP2;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP3;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'] - $growthValue;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $growthValue;//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

		//vip 3
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP3)['min'] && $growthValue < $this->getMaxMinGrowthByVipLevel(self::VIP3)['max'])
		{
			$currentLevelLable = self::VIP3;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP4;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'] - $growthValue;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $growthValue;//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

		//vip 4
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP4)['min'] && $growthValue < $this->getMaxMinGrowthByVipLevel(self::VIP4)['max'])
		{
			$currentLevelLable = self::VIP4;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP5;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'] - $growthValue;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $growthValue;//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

		//vip 5
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP5)['min'] && $growthValue < $this->getMaxMinGrowthByVipLevel(self::VIP5)['max'])
		{
			$currentLevelLable = self::VIP5;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP6;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'] - $growthValue;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $growthValue;//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

		//vip 6
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP6)['min'] && $growthValue < $this->getMaxMinGrowthByVipLevel(self::VIP6)['max'])
		{
			$currentLevelLable = self::VIP6;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP7;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'] - $growthValue;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $growthValue;//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

		//vip 7
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP7)['min'] && $growthValue < $this->getMaxMinGrowthByVipLevel(self::VIP7)['max'])
		{
			$currentLevelLable = self::VIP7;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP8;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'] - $growthValue;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $growthValue;//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

		//vip 8
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP8)['min'] && $growthValue < $this->getMaxMinGrowthByVipLevel(self::VIP8)['max'])
		{
			$currentLevelLable = self::VIP8;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP9;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'] - $growthValue;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $growthValue;//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

		//vip 9
		if ($growthValue >= $this->getMaxMinGrowthByVipLevel(self::VIP9)['min'])
		{
			$currentLevelLable = self::VIP9;//当前vip等级对应的标签
			$nextLevelLabel = self::VIP9;//下一个vip等级对应的标签

			$result['vip-level'] = $currentLevelLable;//vip等级
			$result['next-level'] = $nextLevelLabel;//下一个等级
			$result['next-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['min'];//到下一个等级所需要的最小成长值
			$result['need-growth-value'] = 0;//升级所需要的成长值
			$result['current-credits'] = $credits;//当前积分
			$result['current-growth-value'] = $this->getMaxMinGrowthByVipLevel($nextLevelLabel)['max'];//当前成长值
			$result['current-percent'] = $growthValue / $this->getMaxMinGrowthByVipLevel($currentLevelLable)['max'] * 100;//当前成长值百分比
			$result['next-level-info'] = $result['current-growth-value'] . ' / ' . $result['next-growth-value'] . ' (' . $result['next-level'] . ')';
			return $result;
		}

	}

}