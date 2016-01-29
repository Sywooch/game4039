<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 21:31
 * Desc:
 */

namespace frontend\models;


use trntv\filekit\behaviors\UploadBehavior;
use yii\base\Model;

class KefuAccountRepairApplicantInfoForm extends Model
{

	public $applicant_name;
	public $applicant_phone;
	public $applicant_identity;
	public $applicant_email;

	public $identity_front_path;
	public $identity_front_base_url;

	public $identity_back_path;
	public $identity_back_base_url;

	public $identity_front;
	public $identity_back;

	public function behaviors()
	{
		return [
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

	public function rules()
	{
		return [
			[['applicant_email', 'applicant_name', 'applicant_identity'], 'required'],
			[['applicant_email'], 'email'],
			[['applicant_name', 'applicant_phone', 'applicant_identity'], 'string'],
			[['identity_front_base_url', 'identity_front_path', 'identity_back_base_url', 'identity_back_path'], 'string', 'max' => 1024],
			[['identity_front', 'identity_back'], 'safe']
		];
	}

	public function attributeLabels()
	{
		return [
			'applicant_name' => '申请人名字',
			'applicant_phone' => '申请人电话',
			'applicant_identity' => '申请人身份证号码',
			'applicant_email' => '申请人联系邮箱',
			'identity_front' => '身份证正面照',
			'identity_back' => '身份证背面照',
		];
	}
}