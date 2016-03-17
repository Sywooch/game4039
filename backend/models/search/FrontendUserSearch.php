<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/3/17
 * Time: 10:14
 * Desc:
 */

namespace backend\models\search;


use dektrium\user\models\UserSearch;
use frontend\models\User;
use yii\data\ActiveDataProvider;

class FrontendUserSearch extends UserSearch
{

	/**
	 * @param $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = User::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		if ($this->created_at !== null) {
			$date = strtotime($this->created_at);
			$query->andFilterWhere(['between', 'created_at', $date, $date + 3600 * 24]);
		}

		$query->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['registration_ip' => $this->registration_ip]);

		return $dataProvider;
	}
}