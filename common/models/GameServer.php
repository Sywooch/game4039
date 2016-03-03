<?php

namespace common\models;

use common\commands\command\AddToTimelineCommand;
use common\models\query\GameServerQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%game_server}}".
 *
 * @property integer $id
 * @property integer $server_id
 * @property string $server_name
 * @property integer $game_id
 * @property string $server_key
 * @property integer $start_time
 * @property string $slug
 * @property integer $is_new
 * @property integer $is_hot
 * @property integer $is_recommend
 * @property integer $is_shutdown
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property Game $game
 */
class GameServer extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

	const IS_NEW_YES = 1;//新服
	const IS_NEW_NO = 0;//不是新服

	const IS_HOT_YES = 1;//热门
	const IS_HOT_NO = 0;//不是热门

	const IS_RECOMMEND_YES = 1;//推荐
	const IS_RECOMMEND_NO = 0;//不推荐

	const IS_SHUT_DOWN_YES = 1;//停服
	const IS_SHUT_DOWN_NO = 0;//没停服

	public function behaviors()
	{
		return [
			[
				'class' => SluggableBehavior::className(),
				'attribute' => 'server_name',
				'slugAttribute' => 'slug',
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
		return '{{%game_server}}';
	}

	/**
	 * @return GameServerQuery
	 */
	public static function find()
	{
		return new GameServerQuery(get_called_class());
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['server_id', 'server_name', 'game_id', 'status'], 'required'],
			['server_id', 'unique'],
			[['server_id', 'game_id', 'is_new', 'is_hot', 'is_recommend', 'is_shutdown', 'created_at', 'updated_at', 'status'], 'integer'],
			[['start_time'], 'default', 'value' => function ()
			{
				return date(DATE_ISO8601);
			}],
			[['start_time'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
			[['server_name', 'server_key', 'slug'], 'string', 'max' => 255],
			[['server_id', 'game_id'], 'unique', 'targetAttribute' => ['server_id', 'game_id'], 'message' => 'The combination of Server ID and Game ID has already been taken.']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'server_id' => Yii::t('common', 'Server ID'),
			'server_name' => Yii::t('common', 'Server Name'),
			'game_id' => Yii::t('common', 'Game ID'),
			'server_key' => Yii::t('common', 'Server Key'),
			'start_time' => Yii::t('common', 'Start Time'),
			'slug' => Yii::t('common', 'Slug'),
			'is_new' => Yii::t('common', 'Is New'),
			'is_hot' => Yii::t('common', 'Is Hot'),
			'is_recommend' => Yii::t('common', 'Is Recommend'),
			'is_shutdown' => Yii::t('common', 'Is Shutdown'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
		];
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

	public function afterSave($insert, $changedAttributes)
	{
		Yii::$app->commandBus->handle(new AddToTimelineCommand([
			'category' => 'game-server',
			'event' => 'save',
			'data' => [
				'created_by' => Yii::$app->user->identity->username,
				'model_id' => $this->id,
				'model_name' => $this->server_name,
				'created_time' => $insert ? $this->created_at : $this->updated_at,
				'method' => $insert ? 'insert' : 'update',
			],
		]));
		parent::afterSave($insert, $changedAttributes);
	}

	public function afterDelete()
	{
		Yii::$app->commandBus->handle(new AddToTimelineCommand([
			'category' => 'game-server',
			'event' => 'delete',
			'data' => [
				'deleted_by' => Yii::$app->user->identity->username,
				'model_id' => $this->id,
				'model_name' => $this->server_name,
				'method' => 'deleted',
				'time' => time(),
			],
		]));
		parent::afterDelete();
	}


}
