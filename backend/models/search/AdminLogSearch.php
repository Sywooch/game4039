<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/16
 * Time: 15:36
 * Desc:
 */

namespace backend\models\search;


use common\models\AdminLog;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdminLogSearch extends AdminLog
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'log_time', 'message'], 'integer'],
			[['category', 'prefix', 'level'], 'safe'],
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
		$query = AdminLog::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'level' => $this->level,
			'log_time' => $this->log_time,
			'message' => $this->message,
		]);

		$query->andFilterWhere(['like', 'category', $this->category])
			->andFilterWhere(['like', 'prefix', $this->prefix]);

		return $dataProvider;
	}

}