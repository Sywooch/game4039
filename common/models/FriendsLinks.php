<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%friends_links}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $category
 * @property string $description
 * @property string $slug
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class FriendsLinks extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;//状态->可用
	const STATUS_NOT_USED = 0;//状态->不可用

	const CATEGORY_GAME = 0;//游戏网站
	const CATEGORY_VIDEO = 1;//视频网站
	const CATEGORY_SOCIAL = 2;//社交网站
	const CATEGORY_PORTAL = 3;//门户网站
	const CATEGORY_SHOP = 4;//购物网站
	const CATEGORY_OTHERS = 5;//其他网站

	const ORDER_DEFAULT = 1;//默认排序

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
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%friends_links}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'url', 'category', 'status'], 'required'],
			[['category', 'sort', 'status'], 'integer'],
			[['name', 'url', 'description', 'slug'], 'string', 'max' => 255],
			[['url'], 'url', 'defaultScheme' => 'http'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'name' => Yii::t('common', 'Name'),
			'url' => Yii::t('common', 'URL'),
			'category' => Yii::t('common', 'Category'),
			'description' => Yii::t('common', 'Description'),
			'slug' => Yii::t('common', 'Slug'),
			'sort' => Yii::t('common', 'Sort'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
		];
	}

	/**
	 * @return array
	 */
	public static function getCategory()
	{
		return [
			self::CATEGORY_GAME => Yii::t('common', 'Category Game'),
			self::CATEGORY_VIDEO => Yii::t('common', 'Category Video'),
			self::CATEGORY_SOCIAL => Yii::t('common', 'Category Social'),
			self::CATEGORY_PORTAL => Yii::t('common', 'Category Portal'),
			self::CATEGORY_SHOP => Yii::t('common', 'Category Shop'),
			self::CATEGORY_OTHERS => Yii::t('common', 'Category Others'),
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
}
