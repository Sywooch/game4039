<?php

namespace common\models;

use dektrium\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%shop_order}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $phone
 * @property string $address
 * @property string $email
 * @property string $notes
 * @property string $status
 * @property string $order_sn
 * @property integer $user_id
 *
 * @property User $user
 * @property ShopOrderItem[] $shopOrderItems
 */
class ShopOrder extends \yii\db\ActiveRecord
{

	const STATUS_NEW = 1;// '新提交订单';
	const STATUS_PAYMENT = 2;// '已付款';
	const STATUS_IN_PROGRESS = 3;// '正在处理订单';
	const STATUS_DONE = 4;// '处理完毕订单';

	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%shop_order}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['phone', 'address'], 'required'],
			[['user_id'], 'integer'],
			[['address', 'notes'], 'string'],
			[['phone', 'email', 'status', 'order_sn'], 'string', 'max' => 255],
			[['email'], 'email'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'phone' => Yii::t('common', 'Phone'),
			'address' => Yii::t('common', 'Address'),
			'email' => Yii::t('common', 'Email'),
			'notes' => Yii::t('common', 'Notes'),
			'status' => Yii::t('common', 'Status'),
			'order_sn' => Yii::t('common', 'Order Sn'),
			'user_id' => Yii::t('common', 'User ID'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getShopOrderItems()
	{
		return $this->hasMany(ShopOrderItem::className(), ['order_id' => 'id']);
	}


	/**
	 *
	 */
	public function setOrderSn()
	{
		$this->order_sn = Yii::$app->formatter->asDatetime(time(), 'php:YmdHis') . mt_rand(1000, 9999);
	}

	/**
	 * @param bool $insert
	 * @return bool
	 */
	public function beforeSave($insert)
	{
		var_dump($insert);
		if (parent::beforeSave($insert))
		{
			if ($this->isNewRecord)
			{
				$this->status = self::STATUS_NEW;
				$this->setOrderSn();
			}
			return true;
		} else
		{
			return false;
		}
	}

	/**
	 * @return array
	 */
	public static function getStatus()
	{
		return [
			self::STATUS_NEW => Yii::t('common', 'Order Status New'),
			self::STATUS_PAYMENT => Yii::t('common', 'Order Status Payment'),
			self::STATUS_IN_PROGRESS => Yii::t('common', 'Order Status In Progress'),
			self::STATUS_DONE => Yii::t('common', 'Order Status Done'),
		];
	}

	/**
	 * @return bool
	 */

	public function sendEmail()
	{
		return Yii::$app->mailer->compose(['html' => 'shopOrder', 'text' => 'shopOrder' ], ['shopOrder' => $this])
			->setFrom([\Yii::$app->params['robotEmail'] => \Yii::$app->name . ' 新订单'])
			->setTo($this->email)
			->setSubject('您提交的新订单')
			->send();
	}
}
