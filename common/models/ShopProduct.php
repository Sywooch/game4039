<?php

namespace common\models;

use common\models\query\ShopProductQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "{{%shop_product}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $category_id
 * @property string $price
 * @property integer $jifen
 * @property string $content
 * @property string $keywords
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property string $img_base_url
 * @property string $img_path
 * @property integer $product_number
 * @property integer $return_jifen
 * @property integer $is_on_sale
 * @property integer $is_delete
 * @property integer $is_hot
 * @property integer $is_promote
 * @property integer $is_check
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property ShopImage[] $shopImages
 * @property ShopOrderItem[] $shopOrderItems
 * @property ShopCategory $category
 *
 * @property ShopCategory $relation_game
 */
class ShopProduct extends \yii\db\ActiveRecord
{

	use CartPositionTrait;

	//该常亮表示该条数据是否可用
	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

	const IS_ON_SALE_UP = 1;//上架
	const IS_ON_SALE_DOWN = 0;//下架

	const IS_DELETE_YES = 1;//删除
	const IS_DELETE_NO = 0;//未删除

	const IS_HOT_YES = 1;//是 热销产品
	const IS_HOT_NO = 0;//不是热销产品

	const IS_PROMOTE_YES = 1;//是促销
	const IS_PROMOTE_NO = 0;//不是促销产品

	const IS_CHECK_YES = 1;
	const IS_CHECK_NO = 0;

	public $thumbnail;
	public $img;

	public function behaviors()
	{
		return [
			[
				'class' => SluggableBehavior::className(),
				'attribute' => 'title',
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
				'attribute' => 'img',
				'pathAttribute' => 'img_path',
				'baseUrlAttribute' => 'img_base_url'
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%shop_product}}';
	}

	/**
	 * @return ShopProductQuery
	 */
	public static function find()
	{
		return new ShopProductQuery(get_called_class());
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'category_id', 'status'], 'required'],
			[['description', 'content'], 'string'],
			[['category_id', 'jifen', 'product_number', 'return_jifen', 'is_on_sale', 'is_delete', 'is_hot', 'is_promote', 'is_check', 'created_at', 'updated_at', 'status', 'relation_game'], 'integer'],
			[['price'], 'number'],
			[['title', 'slug', 'keywords'], 'string', 'max' => 255],
			[['thumbnail_base_url', 'thumbnail_path', 'img_base_url', 'img_path'], 'string', 'max' => 1024],
			[['thumbnail', 'img'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'title' => Yii::t('common', 'Title'),
			'slug' => Yii::t('common', 'Slug'),
			'description' => Yii::t('common', 'Description'),
			'category_id' => Yii::t('common', 'Category ID'),
			'price' => Yii::t('common', 'Price'),
			'jifen' => Yii::t('common', 'Jifen'),
			'content' => Yii::t('common', 'Content'),
			'keywords' => Yii::t('common', 'Keywords'),
			'thumbnail' => Yii::t('common', 'Thumbnail'),
			'img' => '大图(1170x300)',
			'thumbnail_base_url' => Yii::t('common', 'Thumbnail Base Url'),
			'thumbnail_path' => Yii::t('common', 'Thumbnail Path'),
			'img_base_url' => Yii::t('common', 'Img Base Url'),
			'img_path' => Yii::t('common', 'Img Path'),
			'product_number' => Yii::t('common', 'Product Number'),
			'return_jifen' => Yii::t('common', 'Return Jifen'),
			'is_on_sale' => Yii::t('common', 'Is On Sale'),
			'is_delete' => Yii::t('common', 'Is Delete'),
			'is_hot' => Yii::t('common', 'Is Hot'),
			'is_promote' => Yii::t('common', 'Is Promote'),
			'is_check' => Yii::t('common', 'Is Check'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
			'relation_game' => Yii::t('common', 'Relation Game'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getShopImages()
	{
		return $this->hasMany(ShopImage::className(), ['product_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getShopOrderItems()
	{
		return $this->hasMany(ShopOrderItem::className(), ['product_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(ShopCategory::className(), ['id' => 'category_id']);
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getJiFen()
	{
		return $this->jifen;
	}

	public function getId()
	{
		return $this->id;
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

	public function getRelationGame()
	{
		return $this->hasOne(Game::className(), ['id' => 'relation_game']);
	}
}
