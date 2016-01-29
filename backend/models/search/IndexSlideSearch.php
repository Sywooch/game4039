<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\IndexSlide;

/**
 * IndexSlideSearch represents the model behind the search form about `common\models\IndexSlide`.
 */
class IndexSlideSearch extends IndexSlide
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'game_id', 'created_at', 'updated_at', 'status', 'sort'], 'integer'],
			[['name', 'caption', 'description', 'access_url', 'official_url', 'thumbnail_base_url', 'thumbnail_path'], 'safe'],
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
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = IndexSlide::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate()))
		{
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'game_id' => $this->game_id,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
			'sort' => $this->sort,
		]);

		$query->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'caption', $this->caption])
			->andFilterWhere(['like', 'description', $this->description])
			->andFilterWhere(['like', 'access_url', $this->access_url])
			->andFilterWhere(['like', 'official_url', $this->official_url])
			->andFilterWhere(['like', 'thumbnail_base_url', $this->thumbnail_base_url])
			->andFilterWhere(['like', 'thumbnail_path', $this->thumbnail_path]);

		return $dataProvider;
	}
}
