<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/24
 * Time: 11:11
 * Desc:
 */

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;


class Profile extends \dektrium\user\models\Profile
{

	const GENDER_MALE = 1;
	const GENDER_FEMALE = 0;

	public function attributeLabels()
	{
		$labels = parent::attributeLabels();
		$labels['nickname'] = Yii::t('common', 'Nickname');
		$labels['gender'] = Yii::t('common', 'Gender');
		$labels['identity_num'] = Yii::t('common', 'Identity Num');
		$labels['qq'] = Yii::t('common', 'QQ');
		$labels['birthday'] = Yii::t('common', 'Birthday');

		return $labels;
	}

	/*
	 * [['published_at'], 'default', 'value' => function ()
			{
				return date(DATE_ISO8601);
		[['published_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],

					}],
	 * */
	public function rules()
	{
		$parentRules = parent::rules();
		$childRules = [
			['nickname', 'string', 'max' => '255'],
			['gender', 'integer'],
			['identity_num', 'string', 'length' => [15, 18]],
			['qq', 'match', 'pattern' => "/^[1-9]*[1-9][0-9]*$/i"],
			['qq', 'string', 'max' => '11'],
			['birthday', 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true]
		];
		$rules = ArrayHelper::merge($parentRules, $childRules);
		return $rules;
	}


	public static function getGenderList()
	{
		return [
			self::GENDER_FEMALE => Yii::t('common', 'Famale'),
			self::GENDER_MALE => Yii::t('common', 'Male')
		];
	}


}