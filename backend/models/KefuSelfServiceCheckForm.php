<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/3/4
 * Time: 11:55
 * Desc:
 */

namespace backend\models;


use common\models\KefuSelfservice;
use yii\base\Model;
use Yii;
use yii\web\NotFoundHttpException;

class KefuSelfServiceCheckForm extends Model
{

	public $status;
	public $result;

	public $_id;

	public function rules()
	{
		return [
			['status','required'],
			['status','integer'],
			['result','string'],
		];
	}

	public function attributeLabels()
	{
		return [
			'status'=>Yii::t('common','Status'),
			'result' => Yii::t('common','Result'),
		];
	}

	public function save(){
		$model=$this->getModel();
		if($this->validate()){
			$model->status=$this->status;
			$model->result=$this->result;
			return $model->save();
		}
		return false;
	}

	public function getModel(){
		if(($model=KefuSelfservice::findOne($this->_id))!==null){
			return $model;
		}else{
			throw new NotFoundHttpException(Yii::t('common','The requested page does not exist.'));
		}
	}


}