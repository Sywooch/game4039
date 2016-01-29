<?php

namespace common\models;

use dektrium\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%user_security_questions}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $security_question_one_id
 * @property string $security_question_one_answer
 * @property integer $security_question_two_id
 * @property string $security_question_two_answer
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property SecurityQuestions $securityQuestionTwo
 * @property SecurityQuestions $securityQuestionOne
 * @property User $user
 */
class UserSecurityQuestions extends \yii\db\ActiveRecord
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
		return '{{%user_security_questions}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'status'], 'required'],
			[['user_id', 'security_question_one_id', 'security_question_two_id', 'created_at', 'updated_at', 'status'], 'integer'],
			[['security_question_one_answer', 'security_question_two_answer'], 'string', 'max' => 255],
			[['user_id'], 'unique']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'user_id' => Yii::t('common', 'User ID'),
			'security_question_one_id' => Yii::t('common', 'Security Question One ID'),
			'security_question_one_answer' => Yii::t('common', 'Security Question One Answer'),
			'security_question_two_id' => Yii::t('common', 'Security Question Two ID'),
			'security_question_two_answer' => Yii::t('common', 'Security Question Two Answer'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSecurityQuestionTwo()
	{
		return $this->hasOne(SecurityQuestions::className(), ['id' => 'security_question_two_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSecurityQuestionOne()
	{
		return $this->hasOne(SecurityQuestions::className(), ['id' => 'security_question_one_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
}
