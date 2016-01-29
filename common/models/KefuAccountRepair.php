<?php

namespace common\models;

use dektrium\user\models\User;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%kefu_account_repair}}".
 *
 * @property integer $id
 * @property string $sn
 * @property integer $account
 * @property integer $reason
 * @property integer $register_time
 * @property string $register_place
 * @property string $recent_games
 * @property string $question_desc
 * @property string $bind_email
 * @property integer $security_question_one
 * @property string $security_question_one_answer
 * @property integer $security_question_two
 * @property string $security_question_two_answer
 * @property string $applicant_name
 * @property string $applicant_phone
 * @property string $applicant_identity
 * @property string $applicant_email
 * @property string $identity_front_base_url
 * @property string $identity_front_path
 * @property string $identity_back_base_url
 * @property string $identity_back_path
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $progress
 * @property integer $status
 *
 * @property SecurityQuestions $securityQuestionTwo
 * @property SecurityQuestions $securityQuestionOne
 */
/*
* 提交完申诉表单后的输出信息如下
* 您的资料已提交成功，我们会在23:58:35内处理完毕，请您耐心等待！
* 本次服务的编号为：201510130949295679，查询密码为：ik8iu8，此项信息也发送至您的手机和邮箱。
* 请您妥善保管，服务编号、查询密码为查询结果的凭证，遗失无法找回！
* 此信息已发送至18309467501（联系手机），请您提供以上信息查询处理结果。
* */

class KefuAccountRepair extends \yii\db\ActiveRecord
{

	const REASON_STOLEN = 0;//账号被盗
	const REASON_FORGET_PASSWORD = 1;//忘记密码
	const REASON_FORGET_EMAIL = 2;//忘记邮箱
	const REASON_MODIFIED_BIND_PHONE = 3;//修改绑定手机号码
	const REASON_MODIFIED_SECURITY_QUESTION = 4;//修改密保
	const REASON_OTHERS = 5;//其他

	const PROGRESS_NEW = 0;//新提交的申请
	const PRPGRESS_DOING = 1;//正在处理
	const PROGRESS_FINISHED = 2;//处理完成

	const STATUS_IN_USE = 1;//使用中
	const STATUS_NOT_USED = 0;//停止使用

	public $identity_front;
	public $identity_back;

	public function behaviors()
	{
		return [
			TimestampBehavior::className(),

			[
				'class' => UploadBehavior::className(),
				'attribute' => 'identity_front',
				'pathAttribute' => 'identity_front_path',
				'baseUrlAttribute' => 'identity_front_base_url'
			],
			[
				'class' => UploadBehavior::className(),
				'attribute' => 'identity_back',
				'pathAttribute' => 'identity_back_path',
				'baseUrlAttribute' => 'identity_back_base_url'
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%kefu_account_repair}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['account', 'reason', 'progress', 'status'], 'required'],
			[['reason', 'account', 'security_question_one', 'security_question_two', 'created_at', 'updated_at', 'progress', 'status'], 'integer'],
			[['question_desc'], 'string'],
			[['sn', 'register_place', 'recent_games', 'bind_email', 'security_question_one_answer', 'security_question_two_answer', 'applicant_name', 'applicant_email'], 'string', 'max' => 255],
			[['applicant_phone'], 'string', 'max' => 20],
			[['applicant_identity'], 'string', 'max' => 18],
			[['identity_front_base_url', 'identity_front_path', 'identity_back_base_url', 'identity_back_path'], 'string', 'max' => 1024],

			[['register_time'], 'default', 'value' => function ()
			{
				return date(DATE_ISO8601);
			}],
			[['register_time'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
			[['identity_front', 'identity_back'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common', 'ID'),
			'sn' => Yii::t('common', 'SN'),

			//第一步填写要修复的账号
			'account' => Yii::t('common', 'Account'),

			//第二步,修复原因
			//0=>账号被盗,1=>忘记密码,2=>忘记注册邮箱,3=>忘记绑定手机号码,4=>修改密保,5=>其他
			'reason' => Yii::t('common', 'Reason'),

			//第三部填写申请基本资料
			'register_time' => Yii::t('common', 'Register Time'),
			'register_place' => Yii::t('common', 'Register Place'),
			'recent_games' => Yii::t('common', 'Recent Games'),
			'question_desc' => Yii::t('common', 'Question Desc'),

			//第四步,填写更多信息
			'bind_email' => Yii::t('common', 'Bind Email'),
			'security_question_one' => Yii::t('common', 'Security Question One'),
			'security_question_one_answer' => Yii::t('common', 'Security Question One Answer'),
			'security_question_two' => Yii::t('common', 'Security Question Two'),
			'security_question_two_answer' => Yii::t('common', 'Security Question Two Answer'),

			//第五步,申请人资料
			'applicant_name' => Yii::t('common', 'Applicant Name'),
			'applicant_phone' => Yii::t('common', 'Applicant Phone'),
			'applicant_identity' => Yii::t('common', 'Applicant Identity'),
			'applicant_email' => Yii::t('common', 'Applicant Email'),


			'identity_front' => Yii::t('common', 'Identity Front'),
			'identity_back' => Yii::t('common', 'Identity Back'),

			'identity_front_base_url' => Yii::t('common', 'Identity Front Base Url'),
			'identity_front_path' => Yii::t('common', 'Identity Front Path'),
			'identity_back_base_url' => Yii::t('common', 'Identity Back Base Url'),
			'identity_back_path' => Yii::t('common', 'Identity Back Path'),

			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'progress' => Yii::t('common', 'Progress'),
			'status' => Yii::t('common', 'Status'),
		];
	}

	/*
	 * get Reason
	 * */
	public static function getReason()
	{
		return [
			self:: REASON_STOLEN => Yii::t('common', 'Reason Stolen'),
			self:: REASON_FORGET_PASSWORD => Yii::t('common', 'Reason Forget Passowrd'),
			self:: REASON_FORGET_EMAIL => Yii::t('common', 'Reason Forget Email'),
			self:: REASON_MODIFIED_BIND_PHONE => Yii::t('common', 'Reason Modified bind Phone'),
			self:: REASON_MODIFIED_SECURITY_QUESTION => Yii::t('common', 'Reason Modified Security Question'),
			self:: REASON_OTHERS => Yii::t('common', 'Reason Others'),
		];
	}

	/*
	 * get progress
	 * */
	public static function getProgress()
	{
		return [
			self::PROGRESS_NEW => Yii::t('common', 'Progress New'),
			self::PRPGRESS_DOING => Yii::t('common', 'Progress Doing'),
			self::PROGRESS_FINISHED => Yii::t('common', 'Progress Finished'),
		];
	}

	/*
	 * get status
	 * */
	public static function getStatus()
	{
		return [
			self::STATUS_IN_USE => Yii::t('common', 'In Use'),
			self::STATUS_NOT_USED => Yii::t('common', 'Not Used'),
		];
	}

	/*
	 * set repair SN
	 * yyyyMMddHHmmss+4bit(digit)
	 * */
	public function setSN()
	{
		$this->sn = Yii::$app->formatter->asDatetime(time(), 'yyyyMMddHHmmss') . mt_rand(1000, 9999);
	}

	public function sendEmail()
	{
		return Yii::$app->mailer->compose(['html' => 'kefuAccountRepair', 'text' => 'kefuAccountRepair' ], ['kefuAccountRepair' => $this])
			->setFrom([\Yii::$app->params['robotEmail'] => \Yii::$app->name . ' 客服中心'])
			->setTo($this->applicant_email)
			->setSubject('游戏帐号修复用户通知')
			->send();
	}

	public function beforeSave($insert)
	{
		$this->setSN();
		return parent::beforeSave($insert);
	}


	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSecurityQuestionTwo()
	{
		return $this->hasOne(SecurityQuestions::className(), ['id' => 'security_question_two']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSecurityQuestionOne()
	{
		return $this->hasOne(SecurityQuestions::className(), ['id' => 'security_question_one']);
	}

	/**
	 * find user by account
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'account']);
	}

	/**
	 * find games by rencent_games field
	 * @return \yii\db\ActiveQuery
	 */
	public function getRecentGames()
	{
		return $this->hasOne(Game::className(), ['id' => 'recent_games']);
	}
}
