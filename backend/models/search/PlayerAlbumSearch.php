<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PlayerAlbum;

/**
 * PlayerAlbumSearch represents the model behind the search form about `common\models\PlayerAlbum`.
 */
class PlayerAlbumSearch extends PlayerAlbum
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
			[['thumbnail_base_url', 'thumbnail_path', 'url'], 'safe'],
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
		$query = PlayerAlbum::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate()))
		{
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
		]);

		$query->andFilterWhere(['like', 'thumbnail_base_url', $this->thumbnail_base_url])
			->andFilterWhere(['like', 'thumbnail_path', $this->thumbnail_path])
			->andFilterWhere(['like', 'url', $this->url]);

		return $dataProvider;
	}
}
