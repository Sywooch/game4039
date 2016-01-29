<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_login_log}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property string $login_ip
 * @property integer $login_time
 * @property string $os
 * @property string $category
 */
class UserLoginLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_login_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'login_time'], 'required'],
            [['user_id', 'login_time'], 'integer'],
            [['username', 'login_ip', 'os', 'category'], 'string', 'max' => 255]
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
            'username' => Yii::t('common', 'Username'),
            'login_ip' => Yii::t('common', 'Login Ip'),
            'login_time' => Yii::t('common', 'Login Time'),
            'os' => Yii::t('common', 'Os'),
            'category' => Yii::t('common', 'Category'),
        ];
    }
}
