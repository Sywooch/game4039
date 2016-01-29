<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/16
 * Time: 9:41
 * Desc:
 */

namespace backend\models;


use yii\base\Model;

class OrderAddForm extends Model
{

	public $orderPhone;
	public $orderAddress;
	public $orderEmail;
	public $orderNotes;

	public $orderItemProductId;
	public $orderItemQuantity;

	public function rules()
	{
		return [
			[['orderPhone','orderAddress','orderItemQuantity'],'required'],
			[['orderPhone','orderAddress','orderEmail'],'string','max'=>255],
			[['orderNotes'],'string'],
			[['orderItemProductId'],'integer'],
			[['orderItemQuantity'],'number'],

		];
	}


}