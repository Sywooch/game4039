<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%security_questions}}".
 *
 * @property integer $id
 * @property string $question
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property UserSecurityQuestions[] $userSecurityQuestions
 * @property UserSecurityQuestions[] $userSecurityQuestions0
 */
class SecurityQuestions extends \yii\db\ActiveRecord
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
        return '{{%security_questions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'status'], 'required'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['question'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'question' => Yii::t('common', 'Question'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'status' => Yii::t('common', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSecurityQuestions()
    {
        return $this->hasMany(UserSecurityQuestions::className(), ['security_question_two_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSecurityQuestions0()
    {
        return $this->hasMany(UserSecurityQuestions::className(), ['security_question_one_id' => 'id']);
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
