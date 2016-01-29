<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%kefu_selfservice_cat}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $slug
 *
 * @property KefuSelfservice[] $kefuSelfservices
 * @property KefuSelfserviceCat $parent
 * @property KefuSelfserviceCat[] $kefuSelfserviceCats
 */
class KefuSelfserviceCat extends \yii\db\ActiveRecord
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
        return '{{%kefu_selfservice_cat}}';
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
    public function getKefuSelfservices()
    {
        return $this->hasMany(KefuSelfservice::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(KefuSelfserviceCat::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKefuSelfserviceCats()
    {
        return $this->hasMany(KefuSelfserviceCat::className(), ['parent_id' => 'id']);
    }
}
