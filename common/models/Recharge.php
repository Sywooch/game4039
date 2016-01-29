<?php

namespace common\models;

use frontend\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%recharge}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $game_id
 * @property integer $server_id
 * @property string $role_id
 * @property string $amount
 * @property string $order_id
 * @property integer $created_at
 * @property integer $status
 * @property integer $pay_mode
 *
 * @property GameServer $server
 * @property Game $game
 * @property User $user
 */
class Recharge extends \yii\db\ActiveRecord
{

	const RECHARGE_SUCCESS = 1;//充值成功
	const RECHARGE_FAILURE = 0;//充值失败
	const PAY_MODE_ZHI_FU_BAO_YU_E = '支付宝余额';//支付宝余额

	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'createdAtAttribute' => 'created_at',
				'updatedAtAttribute' => null,
			],

		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%recharge}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'game_id', 'server_id', 'role_id', 'amount', 'order_id'], 'required'],
			[['user_id', 'game_id', 'server_id', 'created_at', 'status'], 'integer'],
			[['amount'], 'number'],
			[['role_id', 'order_id', 'pay_mode'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'user_id' => Yii::t('common', 'User ID'),
			'game_id' => Yii::t('common', 'Game ID'),
			'server_id' => Yii::t('common', 'Server ID'),
			'role_id' => Yii::t('common', 'Role ID'),
			'amount' => Yii::t('common', 'Amount'),
			'order_id' => Yii::t('common', 'Order ID'),
			'created_at' => Yii::t('common', 'Created At'),
			'status' => Yii::t('common', 'Status'),
			'pay_mode' => Yii::t('common', 'Pay Mode'),
		];
	}

	public function setOrderId()
	{
		$this->order_id = Yii::$app->formatter->asDatetime(time(), 'php:YmdHis') . mt_rand(1000, 9999);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getServer()
	{
		return $this->hasOne(GameServer::className(), ['id' => 'server_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGame()
	{
		return $this->hasOne(Game::className(), ['id' => 'game_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public static function getStatus()
	{
		return [
			self::RECHARGE_SUCCESS => Yii::t('common', 'Success'),
			self::RECHARGE_FAILURE => Yii::t('common', 'Failure'),
		];
	}

	public static function getPayMode()
	{
		return [
			self::PAY_MODE_ZHI_FU_BAO_YU_E => Yii::t('common', 'Pay Mode Zhi Fu Bao Yu E'),
		];
	}
}
