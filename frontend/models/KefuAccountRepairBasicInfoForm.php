<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 21:20
 * Desc:
 */

namespace frontend\models;


use yii\base\Model;

class KefuAccountRepairBasicInfoForm extends Model
{

	public $register_time;
	public $register_place;
	public $recent_games;
	public $question_desc;

	public function rules()
	{
		return [
			[['recent_games', 'question_desc'], 'required'],
			[['register_time'], 'safe'],
			[['register_place', 'recent_games', 'question_desc'], 'string'],
		];
	}

	public function attributeLabels()
	{
		return [
			'register_time' => '注册时间',
			'register_place' => '注册地点',
			'recent_games' => '最近玩的游戏',
			'question_desc' => '问题描述',
		];
	}
}