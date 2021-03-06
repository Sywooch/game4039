<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%kefu_selfservice_attachment}}".
 *
 * @property integer $id
 * @property integer $selfservice_id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property integer $created_at
 *
 * @property KefuSelfservice $selfservice
 */
class KefuSelfserviceAttachment extends \yii\db\ActiveRecord
{
	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'updatedAtAttribute' => false
			]
		];
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kefu_selfservice_attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['selfservice_id', 'path'], 'required'],
            [['selfservice_id', 'size', 'created_at'], 'integer'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255],
			[['selfservice_id'], 'exist', 'skipOnError' => true, 'targetClass' => KefuSelfservice::className(), 'targetAttribute' => ['selfservice_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'selfservice_id' => Yii::t('common', 'Selfservice ID'),
            'path' => Yii::t('common', 'Path'),
            'base_url' => Yii::t('common', 'Base Url'),
            'type' => Yii::t('common', 'Type'),
            'size' => Yii::t('common', 'Size'),
            'name' => Yii::t('common', 'Name'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelfservice()
    {
        return $this->hasOne(KefuSelfservice::className(), ['id' => 'selfservice_id']);
    }
	public function getUrl()
	{
		return $this->base_url .'/'. $this->path;
	}
}
