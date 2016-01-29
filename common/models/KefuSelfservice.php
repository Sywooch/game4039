<?php

namespace common\models;

use dektrium\user\models\User;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%kefu_selfservice}}".
 *
 * @property integer $id
 * @property string $sn
 * @property integer $category_id
 * @property string $game_role
 * @property integer $game_server
 * @property string $email
 * @property string $phone
 * @property string $result
 * @property string $content
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property KefuSelfserviceCat $category
 * @property User $user
 * @property KefuSelfserviceAttachment[] $kefuSelfserviceAttachments
 */
class KefuSelfservice extends \yii\db\ActiveRecord
{

	const STATUS_YIJIESHOU = 1;//已接受
	const STATUS_YICHULI = 2;//已处理
	const STATUS_YICHANG = 3;//异常

	public $attachments;

	public function behaviors()
	{
		return [
			TimestampBehavior::className(),

			[
				'class' => UploadBehavior::className(),
				'attribute' => 'attachments',
				'multiple' => true,
				'uploadRelation' => 'kefuSelfserviceAttachments',
				'pathAttribute' => 'path',
				'baseUrlAttribute' => 'base_url',
				'orderAttribute' => 'order',
				'typeAttribute' => 'type',
				'sizeAttribute' => 'size',
				'nameAttribute' => 'name',
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%kefu_selfservice}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['category_id', 'status','game_server','content'], 'required'],
			[['category_id', 'game_server', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
			[['result', 'content'], 'string'],
			[['sn', 'game_role', 'email', 'phone'], 'string', 'max' => 255],
			[['attachments'], 'safe']
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
			'category_id' => Yii::t('common', 'Category ID'),
			'game_role' => Yii::t('common', 'Game Role'),
			'game_server' => Yii::t('common', 'Game Server'),
			'email' => Yii::t('common', 'Email'),
			'phone' => Yii::t('common', 'Phone'),
			'result' => Yii::t('common', 'Result'),
			'attachments' => Yii::t('common', 'Attachments'),
			'content' => Yii::t('common', 'Content'),
			'user_id' => Yii::t('common', 'User ID'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
		];
	}

	/*
	 * get status
	 * */
	public static function getStatus()
	{
		return [
			self::STATUS_YIJIESHOU => Yii::t('common', 'Yi Jie Show'),
			self::STATUS_YICHANG => Yii::t('common', 'Yi Chang'),
			self::STATUS_YICHULI => Yii::t('common', 'Yi Chu Li')
		];
	}

	public function beforeSave($insert)
	{
		$this->setSN();
		return parent::beforeSave($insert);
	}


	/*
	 * set sn field and user_id field
	 * */
	public function setAdditional()
	{
		//$this->setSN();
		$this->user_id = Yii::$app->user->getId();
		$this->status = KefuSelfservice::STATUS_YIJIESHOU;
	}

	/*
	 * set repair SN
	 * yyyyMMddHHmmss+4bit(digit)
	 * */
	public function setSN()
	{
		$this->sn = Yii::$app->formatter->asDatetime(time(), 'yyyyMMddHHmmss') . mt_rand(1000, 9999);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(KefuSelfserviceCat::className(), ['id' => 'category_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function getGameServer()
	{
		return $this->hasOne(GameServer::className(), ['id' => 'game_server']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getKefuSelfserviceAttachments()
	{
		return $this->hasMany(KefuSelfserviceAttachment::className(), ['selfservice_id' => 'id']);
	}
}
