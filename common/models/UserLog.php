<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_log}}".
 *
 * @property integer $id
 * @property integer $level
 * @property string $category
 * @property integer $log_time
 * @property string $prefix
 * @property string $message
 */
class UserLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'log_time'], 'required'],
            [['level', 'log_time'], 'integer'],
            [['prefix', 'message'], 'string'],
            [['category'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'level' => Yii::t('common', 'Level'),
            'category' => Yii::t('common', 'Category'),
            'log_time' => Yii::t('common', 'Log Time'),
            'prefix' => Yii::t('common', 'Prefix'),
            'message' => Yii::t('common', 'Message'),
        ];
    }
}
