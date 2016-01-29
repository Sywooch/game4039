<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 16:33
 * Desc:
 */

namespace frontend\models;

use yii\base\Model;
use yii\validators\EmailValidator;

class KefuAccountRepairCheckAccountForm extends Model
{

	public $account;
	public $id;

	public function rules()
	{
		return [
			[['account'], 'required'],
			[['account'], 'string'],
		];
	}


	public function attributeLabels()
	{
		return [
			'account' => '账号',
		];
	}

	/*
	 * check user account
	 * @param string $account(email|username)
	 * @return static|null
	 * */
	public function checkAccount()
	{

		$ev = new EmailValidator();

		if ($ev->validate($this->account))
		{
			$model = User::findOne(['email' => $this->account]);
			if ($model != null)
			{
				$this->id = $model->id;
			}
			return $model;
		} else
		{
			$model = User::findOne(['username' => $this->account]);
			if ($model != null)
			{
				$this->id = $model->id;
			}
			return $model;
		}
	}

}