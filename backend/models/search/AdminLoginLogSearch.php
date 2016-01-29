<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/16
 * Time: 14:31
 * Desc:
 */

namespace backend\models\search;


use common\models\AdminLoginLog;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdminLoginLogSearch extends AdminLoginLog
{

	public function rules(){
		return [
			[['id','user_id','login_time'],'integer'],
			[['username','login_ip','os','category'],'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = AdminLoginLog::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'user_id' => $this->user_id,
			'login_time' => $this->login_time,
			'login_ip'=>$this->login_ip,

		]);

		$query->andFilterWhere(['like', 'category', $this->category])
			->andFilterWhere(['like', 'os', $this->os])
			->andFilterWhere(['like','username',$this->username]);

		return $dataProvider;
	}

}