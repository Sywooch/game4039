<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%index_slide}}".
 *
 * @property integer $id
 * @property integer $game_id
 * @property string $name
 * @property string $caption
 * @property string $description
 * @property string $access_url
 * @property string $official_url
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $sort
 *
 * @property Game $game
 */
class IndexSlide extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

	public $thumbnail;

	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
			],
			[
				'class' => UploadBehavior::className(),
				'attribute' => 'thumbnail',
				'pathAttribute' => 'thumbnail_path',
				'baseUrlAttribute' => 'thumbnail_base_url'
			],

		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%index_slide}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['game_id', 'status', 'thumbnail', 'name'], 'required'],
			[['game_id', 'created_at', 'updated_at', 'status', 'sort'], 'integer'],
			[['description'], 'string'],
			[['name', 'caption'], 'string', 'max' => 255],
			[['access_url', 'official_url', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
			['thumbnail', 'safe'],
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
			'name' => Yii::t('common', 'Name'),
			'caption' => Yii::t('common', 'Caption'),
			'description' => Yii::t('common', 'Description'),
			'access_url' => Yii::t('common', 'Access URL'),
			'official_url' => Yii::t('common', 'Official URL'),
			'thumbnail' => Yii::t('common', 'Thumbnail'),
			'thumbnail_base_url' => Yii::t('common', 'Thumbnail Base Url'),
			'thumbnail_path' => Yii::t('common', 'Thumbnail Path'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
			'sort' => Yii::t('common', 'Sort'),
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
}
