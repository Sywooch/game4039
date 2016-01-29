<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/2
 * Time: 21:12
 * Desc:
 */

namespace frontend\models;


use yii\base\Model;

class KefuAccountRepairReasonForm extends Model
{
	public $reason;

	public function rules()
	{
		return [
			[['reason'], 'required'],
			[['reason'], 'integer'],
		];
	}

	public function attributeLabels()
	{
		return [
			'reason' => '申诉原因',
		];
	}

}