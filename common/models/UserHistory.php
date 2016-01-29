<?php

namespace common\models;

use dektrium\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%user_history}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $game_id
 * @property integer $server_id
 * @property integer $created_at
 * @property integer $status
 *
 * @property GameServer $server
 * @property User $user
 */
class UserHistory extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

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
		return '{{%user_history}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'game_id', 'server_id', 'status'], 'required'],
			[['user_id', 'game_id', 'server_id', 'created_at', 'status'], 'integer'],
			[['user_id', 'server_id', 'created_at'], 'unique', 'targetAttribute' => ['user_id', 'server_id', 'created_at'], 'message' => 'The combination of User ID, Server ID and Created At has already been taken.']
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
			'created_at' => Yii::t('common', 'Created At'),
			'status' => Yii::t('common', 'Status'),
		];
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
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
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
	public static function getStatus()
	{
		return [
			self::STATUS_NOT_USED => Yii::t('common', 'Not Used'),
			self::STATUS_IN_USE => Yii::t('common', 'In Use')
		];
	}
}
