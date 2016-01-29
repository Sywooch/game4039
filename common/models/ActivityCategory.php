<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%activity_category}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $slug
 *
 * @property Activity[] $activities
 * @property ActivityCategory $parent
 * @property ActivityCategory[] $activityCategories
 */
class ActivityCategory extends \yii\db\ActiveRecord
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
        return '{{%activity_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['title'], 'required'],
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
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ActivityCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityCategories()
    {
        return $this->hasMany(ActivityCategory::className(), ['parent_id' => 'id']);
    }
}
