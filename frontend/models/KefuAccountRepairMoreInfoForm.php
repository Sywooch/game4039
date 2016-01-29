<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 21:27
 * Desc:
 */

namespace frontend\models;


use yii\base\Model;

class KefuAccountRepairMoreInfoForm extends Model
{
	public $bind_email;
	public $security_question_one;
	public $security_question_one_answer;
	public $security_question_two;
	public $security_question_two_answer;

	public function rules()
	{
		return [
			[['bind_email'], 'required'],
			[['bind_email'], 'email'],
			[['security_question_one', 'security_question_two'], 'integer'],
			[['security_question_one_answer', 'security_question_two_answer'], 'string'],
		];
	}

	public function attributeLabels()
	{
		return [
			'bind_email' => '绑定的邮箱',
			'security_question_one' => '密保问题1',
			'security_question_one_answer' => '密保问题1答案',
			'security_question_two' => '密保问题2',
			'security_question_two_answer' => '密保问题2答案',
		];
	}

}