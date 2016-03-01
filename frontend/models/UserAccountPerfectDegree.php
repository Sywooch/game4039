<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/3/1
 * Time: 10:21
 * Desc:
 */

namespace frontend\models;


class UserAccountPerfectDegree
{

	public $profile;
	public $perfectDegree=0;

	function __construct($userId)
	{
		$this->profile=Profile::findOne(['user_id' => $userId]);
	}


	/**
	 * 根据用户的profile表中内容鉴定其账号完善度
	 * @return int
	 */
	public function getUserAccountPerfectDegree(){

		if($this->profile !=null){

			//完善真实姓名+10%
			if($this->profile->name !== null){
				$this->perfectDegree+=10;
			}
			//完善公开电子邮箱+10%
			if($this->profile->public_email !== null){
				$this->perfectDegree+=10;
			}
			//完善位置+10%
			if($this->profile->location !== null){
				$this->perfectDegree+=10;
			}
			//完善个性签名+10%
			if($this->profile->bio !== null){
				$this->perfectDegree+=10;
			}
			//完善昵称+10%
			if($this->profile->nickname !== null){
				$this->perfectDegree+=10;
			}
			//完善性别+10%
			if($this->profile->gender !== null){
				$this->perfectDegree+=10;
			}
			//完善身份证号码+10%
			if($this->profile->identity_num !== null){
				$this->perfectDegree+=10;
			}
			//完善qq+10%
			if($this->profile->qq !== null){
				$this->perfectDegree+=10;
			}

			//完善生日+10%
			if($this->profile->birthday !== null){
				$this->perfectDegree+=10;
			}
		}

		if($this->perfectDegree>=100){
			$this->perfectDegree=100;
		}
		return $this->perfectDegree;

	}
}