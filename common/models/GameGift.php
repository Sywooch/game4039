<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%game_gift}}".
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $game_server_id
 * @property string $lb_gid
 * @property string $lb_name
 * @property string $lb_type
 * @property string $lb_method
 * @property string $lb_content
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property GameServer $gameServer
 * @property Game $game
 */
class GameGift extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

	public function behaviors()
	{
		return [
			[
				'class' => SluggableBehavior::className(),
				'attribute' => 'lb_name',
				'slugAttribute' => 'slug'
			],
			[
				'class' => TimestampBehavior::className(),
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%game_gift}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['lb_gid', 'lb_name', 'game_server_id', 'lb_type', 'status'], 'required'],
			[['game_id', 'game_server_id', 'status'], 'integer'],
			[['lb_method', 'lb_content'], 'string'],
			[['lb_gid', 'lb_name', 'lb_type', 'slug'], 'string', 'max' => 255],
			[['lb_gid', 'game_id'], 'unique', 'targetAttribute' => ['lb_gid', 'game_id'], 'message' => 'The combination of Game ID and Lb Gid has already been taken.']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'game_id' => Yii::t('common', 'Game ID'),
			'game_server_id' => Yii::t('common', 'Game Server ID'),
			'lb_gid' => Yii::t('common', 'Lb Gid'),
			'lb_name' => Yii::t('common', 'Lb Name'),
			'lb_type' => Yii::t('common', 'Lb Type'),
			'lb_method' => Yii::t('common', 'Lb Method'),
			'lb_content' => Yii::t('common', 'Lb Content'),
			'slug' => Yii::t('common', 'Slug'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGameServer()
	{
		return $this->hasOne(GameServer::className(), ['id' => 'game_server_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGame()
	{
		return $this->hasOne(Game::className(), ['id' => 'game_id']);
	}

	/**
	 * @return array
	 */
	public static function getStatus()
	{
		return [
			self::STATUS_NOT_USED => Yii::t('common', 'Not Used'),
			self::STATUS_IN_USE => Yii::t('common', 'In Use'),
		];
	}
}
