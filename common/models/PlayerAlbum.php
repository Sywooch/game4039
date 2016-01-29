<?php

namespace common\models;

use common\commands\command\AddToTimelineCommand;
use dektrium\user\models\User;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tq_player_album".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property string $url
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class PlayerAlbum extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;
	const STATUS_NOT_USED = 0;

	public $thumbnail;

	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
			[
				'class' => UploadBehavior::className(),
				'attribute' => 'thumbnail',
				'pathAttribute' => 'thumbnail_path',
				'baseUrlAttribute' => 'thumbnail_base_url'
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%player_album}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'status'], 'required'],
			[['status'], 'integer'],
			[['url'], 'string', 'max' => 255],
			[['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
			['thumbnail', 'safe']
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
			'thumbnail' => Yii::t('common', 'Thumbnail'),
			'thumbnail_base_url' => Yii::t('common', 'Thumbnail Base Url'),
			'thumbnail_path' => Yii::t('common', 'Thumbnail Path'),
			'url' => Yii::t('common', 'Url'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Active'),
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
	 * @param bool $insert
	 * @param array $changedAttributes
	 */
	public function afterSave($insert, $changedAttributes)
	{
		Yii::$app->commandBus->handle(new AddToTimelineCommand([
			'category' => 'player-album',
			'event' => 'save',
			'data' => [
				'created_by' => Yii::$app->user->identity->username,
				'model_id' => $this->id,
				'created_time' => $this->created_at,
			]
		]));
		parent::afterSave($insert, $changedAttributes);
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
