<?php

namespace common\models;

use common\models\query\GameQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%game}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $description
 * @property string $short
 * @property string $api_key
 * @property string $factory
 * @property string $cname
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property string $coin
 * @property integer $coin_rate
 * @property string $game_web_url
 * @property string $game_bbs_url
 * @property string $api_secret
 * @property string $api_server
 * @property string $api_play
 * @property string $api_pay
 * @property string $api_check
 * @property string $api_order
 * @property integer $q
 * @property integer $attr
 * @property integer $is_recommend
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $bg_image_base_url
 * @property integer $bg_image_path
 *
 * @property integer $sort
 * @property GameCategory $category
 */
class Game extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

	//0=>'未接入',1=>'已接入',2=>'接入测试',3=>'停止接入'
	const ATTR_WEI_JIE_RU = 0;
	const ATTR_YI_JIE_RU = 1;
	const ATTR_JIE_RU_CE_SHI = 2;
	const ATTR_TING_ZHI_JIE_RU = 3;

	const IS_RECOMMEND_YES = 1;//推荐
	const IS_RECOMMEND_NO = 0;//不推荐

	public $thumbnail;
	public $bg_image;

	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
			[
				'class' => SluggableBehavior::className(),
				'attribute' => 'name',
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
		return '{{%game}}';
	}

	/**
	 * @return GameQuery
	 */
	public static function find()
	{
		return new GameQuery(get_called_class());
	}


	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['category_id', 'name', 'short', 'attr', 'status'], 'required'],
			[['category_id', 'coin_rate', 'q', 'attr', 'is_recommend', 'created_at', 'updated_at', 'status'], 'integer'],
			['sort', 'default', 'value' => 0],
			[['description'], 'string'],
			[['name', 'short', 'api_key', 'factory', 'cname', 'coin', 'game_web_url', 'game_bbs_url', 'api_secret', 'api_server', 'api_play', 'api_pay', 'api_check', 'api_order', 'slug'], 'string', 'max' => 255],
			[['thumbnail_base_url', 'thumbnail_path', 'bg_image_base_url', 'bg_image_path'], 'string', 'max' => 1024],
			[['thumbnail','bg_image'], 'safe'],
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
			'name' => Yii::t('common', 'Name'),
			'description' => Yii::t('common', 'Description'),
			'short' => Yii::t('common', 'Short'),
			'api_key' => Yii::t('common', 'Api Key'),
			'factory' => Yii::t('common', 'Factory'),
			'cname' => Yii::t('common', 'Cname'),
			'thumbnail' => Yii::t('common', 'Thumbnail'),
			'coin' => Yii::t('common', 'Game Coin'),
			'coin_rate' => Yii::t('common', 'Game Coin Rate(1:x)'),
			'game_web_url' => Yii::t('common', 'Game Web URL'),
			'game_bbs_url' => Yii::t('common', 'Game Bbs URL'),
			'api_secret' => Yii::t('common', 'Api Secret'),
			'api_server' => Yii::t('common', 'Api Server'),
			'api_play' => Yii::t('common', 'Api Play'),
			'api_pay' => Yii::t('common', 'Api Pay'),
			'api_check' => Yii::t('common', 'Api Check'),
			'api_order' => Yii::t('common', 'Api Order'),
			'q' => Yii::t('common', 'Q'),
			'attr' => Yii::t('common', 'Attr'),
			'is_recommend' => Yii::t('common', 'Is Recommend'),
			'slug' => Yii::t('common', 'Slug'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
			'sort' => Yii::t('common','Sort'),
			'bg_image_base_url' => Yii::t('common', 'Background Image Base URL'),
			'bg_image_path' => Yii::t('common', 'Background Image Path'),
			'bg_image' => Yii::t('common', 'Bg Image'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(GameCategory::className(), ['id' => 'category_id']);
	}

	/**
	 * @return array
	 */
	public static function getAttr()
	{
		return [
			self::ATTR_WEI_JIE_RU => Yii::t('common', 'Wei Jie Ru'),
			self::ATTR_JIE_RU_CE_SHI => Yii::t('common', 'Jie Ru Ce Shi'),
			self::ATTR_YI_JIE_RU => Yii::t('common', 'Yi Jie Ru'),
			self::ATTR_TING_ZHI_JIE_RU => Yii::t('common', 'Ting Zhi Jie Ru')
		];
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
	 * @return string
	 */
	public function getThumbnailUrl()
	{
		return $this->thumbnail_base_url . '/' . $this->thumbnail_path;
	}

	/**
	 * @return string
	 */
	public function getBgUrl()
	{
		return $this->bg_image_base_url . '/' . $this->bg_image_path;
	}
}
