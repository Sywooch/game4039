<?php

namespace common\models;

use frontend\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $receive
 * @property string $unread
 * @property string $sender
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $deleted
 */
class Message extends \yii\db\ActiveRecord
{

	/**
	 *
	 */
	const RECEIVE_ALL_SITE_USER = 0;//0代表全站用户

	const STATUS_ACTIVE = 1;//可用状态
	const STATUS_DELETED = 0;//删除状态


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
		return '{{%message}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content', 'receive', 'unread', 'deleted'], 'string'],
			[['status', 'title'], 'required'],
			[['created_at', 'updated_at', 'status'], 'integer'],
			[['title', 'sender'], 'string', 'max' => 255]
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
			'content' => Yii::t('common', 'Content'),
			'receive' => Yii::t('common', 'Receive'),
			'unread' => Yii::t('common', 'Unread'),
			'sender' => Yii::t('common', 'Sender'),
			'created_at' => Yii::t('common', 'Created At'),
			'updated_at' => Yii::t('common', 'Updated At'),
			'status' => Yii::t('common', 'Status'),
			'deleted' => Yii::t('common', 'Deleted'),
		];
	}


	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert))
		{
			// ...custom code here..
			//unread初始值为所有接收人,添加未阅读的用户id
			if (true)
			{
				$user = User::find()->select('id')->asArray()->all();
				$user = ArrayHelper::getColumn($user, 'id');
				$this->unread = implode(',', $user);
			}
			//...custom code end
			return true;
		} else
		{
			return false;
		}
	}

	/**
	 * @return array
	 */
	public static function getStatus()
	{
		return [
			self::STATUS_ACTIVE => Yii::t('common', 'Status Active'),
			self::STATUS_DELETED => Yii::t('common', 'Status Deleted'),
		];
	}

	/**
	 * @return array
	 */
	public static function getReceive()
	{
		return [
			self::RECEIVE_ALL_SITE_USER => Yii::t('common', 'All Site User')];
	}

	/**
	 * 根据用户的id查找未阅读的消息,返回所有未读消息
	 * @param $userid
	 * @return array
	 */
	public static function findUnreadMessagesByUserId($userid)
	{

		$sql = "SELECT * FROM {{%message}} WHERE FIND_IN_SET($userid,`unread`)";
		return Yii::$app->db->createCommand($sql)->queryAll();
	}

	/**
	 *
	 * 用message表中删除已阅读用户的id,返回0表示删除失败,返回大于0表示成功
	 * @param $messageId
	 * @param $userId
	 * @return int 0=>删除失败,1=>成功删除
	 * @throws \yii\db\Exception
	 */
	public static function removeUnreadByUserId($messageId, $userId)
	{

		//读取数据库中unread字段值
		$message = Message::find()->where(['id' => $messageId])->one();
		$unread = $message->unread;

		//转换成数组
		$unread = explode(',', $unread);

		//移出对应的userid
		if (in_array($userId, $unread))
		{
			$key = array_search($userId, $unread);
			ArrayHelper::remove($unread, $key);

			//数组在用","连接转换成字符串
			$unread = implode(',', $unread);

			//更新unread字段
			return Yii::$app->db->createCommand()->update('{{%message}}', ['unread' => $unread], ['id' => $messageId])->execute();
		}
		return 0;
	}

	/**
	 * 删除消息,根据用户id,消息id从message表中标记特定用户已经删除的消息
	 * @param $messageId
	 * @param $userId
	 * @return bool
	 */
	public static function deleteMessageByUserId($messageId, $userId)
	{
		//读取数据库中deleted字段值
		$message = Message::find()->where(['id' => $messageId])->one();
		$deleted = $message->deleted;

		//如果deleted字段不等于null
		if ($deleted)
		{
			$deletedArr = explode(',', $deleted);
			//如果已删除字段在deleted字段中,则跳过
			if (in_array($userId, $deletedArr))
			{
				return true;
			} else
			{
				$deleted .= ',' . $userId;
			}
		} else
		{
			$deleted = $userId;
		}
		//更新message中的deleted字段
		$message->deleted=(string)$deleted;
		if(!$message->save()){
			myVarDump($message->getErrors());
		}
		return $message->save();
	}
}
