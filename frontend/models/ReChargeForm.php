<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/25
 * Time: 9:47
 * Desc:
 */

namespace frontend\models;


use common\models\Game;
use yii\base\Model;
use Yii;

class ReChargeForm extends Model
{

	public $user_id;
	public $game_id;
	public $server_id;
	//public $role_id;
	public $amount;
	public $pay_mode;

	public function rules()
	{
		return [
			[['user_id', 'game_id', 'server_id', 'amount', 'pay_mode'], 'required'],
			[[ 'game_id', 'server_id'], 'integer'],
			[['amount'], 'number','min' => 10],
			[['pay_mode','user_id'], 'string'],
		];
	}

	public function attributeLabels()
	{
		return [
			'user_id' => '您的充值账号',
			'game_id' => '选择游戏',
			'server_id' => '选择服务器',
			'amount' => '充值金额',
			'pay_mode' => '支付方式',
		];
	}

	public function save()
	{
		return 1;
	}

}