<?php

namespace common\models;

use backend\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%kefu_qq}}".
 *
 * @property integer $id
 * @property string $qq
 * @property integer $user_id
 * @property string $user_name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property User $user
 */
class KefuQq extends \yii\db\ActiveRecord
{

	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

	/**
	 * @inheritdoc
	 */
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
        return '{{%kefu_qq}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qq', 'user_id', 'status'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['qq'], 'string', 'max' => 12],
            [['user_name'], 'string', 'max' => 255]
        ];
    }

	public function beforeSave($insert)
	{
		$this->user_name=User::findOne($this->user_id)['username'];
		return parent::beforeSave($insert);
	}

	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'qq' => Yii::t('common', 'QQ'),
            'user_id' => Yii::t('common', 'User ID'),
            'user_name' => Yii::t('common', 'User Name'),
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
