<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 15:16
 * Desc:
 */

namespace frontend\models;


use common\models\KefuQq;
use yii\base\Model;

class KefuQqValidateForm extends Model
{

	public $qq;

	public function rules()
	{
		return [
			[['qq'], 'required'],
			[['qq'], 'string'],
		];
	}

	public function attributeLabels()
	{
		return [
			'qq' => 'QQ',
		];
	}

	/**
	 * validate official qq
	 * @return bool
	 */
	public function validateQq()
	{
		$qq = KefuQq::findOne(['qq' => $this->qq]);

		if ($qq != null)
		{
			return true;
		}
		return false;
	}

}