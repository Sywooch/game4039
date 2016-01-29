<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%kefu_faq_cat}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $slug
 *
 * @property KefuFaq[] $kefuFaqs
 * @property KefuFaqCat $parent
 * @property KefuFaqCat[] $kefuFaqCats
 */
class KefuFaqCat extends \yii\db\ActiveRecord
{

	public function behaviors()
	{
		return [
			[
				'class' => SluggableBehavior::className(),
				'attribute' => 'title',
				'slugAttribute' => 'slug'
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%kefu_faq_cat}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['parent_id'], 'integer'],
			[['title', 'slug'], 'required'],
			[['title', 'slug'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'parent_id' => Yii::t('common', 'Parent ID'),
			'title' => Yii::t('common', 'Title'),
			'slug' => Yii::t('common', 'Slug'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getKefuFaqs()
	{
		return $this->hasMany(KefuFaq::className(), ['category_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getParent()
	{
		return $this->hasOne(KefuFaqCat::className(), ['id' => 'parent_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getKefuFaqCats()
	{
		return $this->hasMany(KefuFaqCat::className(), ['parent_id' => 'id']);
	}
}
