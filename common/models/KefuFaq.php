<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%kefu_faq}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $category_id
 * @property string $description
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property KefuFaqCat $category
 */
class KefuFaq extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

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
		return '{{%kefu_faq}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'category_id', 'status'], 'required'],
			[['category_id', 'created_at', 'updated_at', 'status'], 'integer'],
			[['content'], 'string'],
			[['title', 'description'], 'string', 'max' => 255]
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
			'category_id' => Yii::t('common', 'Category ID'),
			'description' => Yii::t('common', 'Description'),
			'content' => Yii::t('common', 'Content'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(KefuFaqCat::className(), ['id' => 'category_id']);
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
