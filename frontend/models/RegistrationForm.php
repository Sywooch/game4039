<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/3/2
 * Time: 10:07
 * Desc:
 */

namespace frontend\models;


use yii\helpers\ArrayHelper;

class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
	public $captcha;

	public function rules()
	{
		$rules=parent::rules();
		$rules[] = ['captcha', 'required'];
		$rules[] = ['captcha', 'captcha'];
		return $rules;
	}

	public function attributeLabels()
	{
		$labels=parent::attributeLabels();
		$labels['captcha']=\Yii::t('common','captcha');
		return $labels;
	}


}