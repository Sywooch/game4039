<?php

namespace common\models;

use common\models\query\ActivityQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%activity}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property integer $start_time
 * @property integer $end_time
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property string $content
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property integer $guize
 * @property integer $jiangli
 * @property integer $jiangli_fangfa
 * @property integer $bg_image_base_url
 * @property integer $bg_image_path
 * @property integer $relation_game_id
 *
 * @property integer $sort
 *
 * @property ActivityCategory $category
 */
class Activity extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

	public $thumbnail;
	public $bg_image;


	public function behaviors()
	{
		return [
			[
				'class' => SluggableBehavior::className(),
				'attribute' => 'title',
				'slugAttribute' => 'slug',
			],
			[
				'class' => TimestampBehavior::className(),
			],
			[
				'class' => UploadBehavior::className(),
				'attribute' => 'thumbnail',
				'pathAttribute' => 'thumbnail_path',
				'baseUrlAttribute' => 'thumbnail_base_url'
			],
			[
				'class' => UploadBehavior::className(),
				'attribute' => 'bg_image',
				'pathAttribute' => 'bg_image_path',
				'baseUrlAttribute' => 'bg_image_base_url'
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%activity}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['category_id', 'title', 'slug', 'status'], 'required'],
			[['category_id', 'status', 'relation_game_id'], 'integer'],
			['sort', 'default', 'value' => 0],

			[['start_time', 'end_time'], 'default', 'value' => function ()
			{
				return date(DATE_ISO8601);
			}],
			[['start_time', 'end_time'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],

			[['description', 'content', 'guize', 'jiangli', 'jiangli_fangfa'], 'string'],
			[['title', 'url', 'slug'], 'string', 'max' => 255],
			[['thumbnail_base_url', 'thumbnail_path', 'bg_image_base_url', 'bg_image_path'], 'string', 'max' => 1024],
			[['thumbnail', 'bg_image'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'category_id' => Yii::t('common', 'Category ID'),
			'title' => Yii::t('common', 'Title'),
			'description' => Yii::t('common', 'Description'),
			'url' => Yii::t('common', 'URL'),
			'start_time' => Yii::t('common', 'Start Time'),
			'end_time' => Yii::t('common', 'End Time'),
			'thumbnail' => Yii::t('common', 'Thumbnail'),
			'thumbnail_base_url' => Yii::t('common', 'Thumbnail Base Url'),
			'thumbnail_path' => Yii::t('common', 'Thumbnail Path'),
			'content' => Yii::t('common', 'Content'),
			'slug' => Yii::t('common', 'Slug'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
			'guize' => Yii::t('common', 'Gui Ze'),
			'jiangli' => Yii::t('common', 'Jiang Li'),
			'jiangli_fangfa' => Yii::t('common', 'Jiang Li Fang Fa'),
			'bg_image_base_url' => Yii::t('common', 'Background Image Base URL'),
			'bg_image_path' => Yii::t('common', 'Background Image Path'),
			'relation_game_id' => Yii::t('common', 'Relation Game ID'),
			'bg_image' => Yii::t('common', 'Bg Image'),
			'sort' => Yii::t('common','Sort'),
		];
	}

	public static function find()
	{
		return new ActivityQuery(get_called_class());
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(ActivityCategory::className(), ['id' => 'category_id']);
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

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGame()
	{
		if ($this->relation_game_id != null)
		{
			return $this->hasOne(Game::className(), ['id' => 'relation_game_id']);
		}
		return new Game();
	}

	/**
	 * @return string
	 */
	public function getBgUrl()
	{
		return $this->bg_image_base_url . '/' . $this->bg_image_path;
	}

	/**
	 * @return string
	 */
	public function getThumbnailUrl()
	{
		return $this->thumbnail_base_url . '/' . $this->thumbnail_path;
	}
}
