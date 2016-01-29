<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Game;

/**
 * GameSearch represents the model behind the search form about `common\models\Game`.
 */
class GameSearch extends Game
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'category_id', 'coin_rate', 'q', 'attr', 'is_recommend', 'created_at', 'updated_at', 'status'], 'integer'],
			[['name', 'description', 'short', 'api_key', 'factory', 'cname', 'thumbnail_base_url', 'thumbnail_path', 'coin', 'game_web_url', 'game_bbs_url', 'api_secret', 'api_server', 'api_play', 'api_pay', 'api_check', 'api_order', 'slug'], 'safe'],
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

		$query = Game::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate()))
		{
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'category_id' => $this->category_id,
			'coin_rate' => $this->coin_rate,
			'q' => $this->q,
			'attr' => $this->attr,
			'is_recommend' => $this->is_recommend,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
		]);

		if (isset($params['GameSearch']['short']))
		{
			$str = $params['GameSearch']['short'];
			$arr = mb_split(',', $str);
			foreach ($arr as $a)
			{
				$query->orFilterWhere(['like','short',$a]);


			}
			$query->statusInUse();

		}

		$query->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'description', $this->description])
			->andFilterWhere(['like', 'api_key', $this->api_key])
			->andFilterWhere(['like', 'factory', $this->factory])
			->andFilterWhere(['like', 'cname', $this->cname])
			->andFilterWhere(['like', 'thumbnail_base_url', $this->thumbnail_base_url])
			->andFilterWhere(['like', 'thumbnail_path', $this->thumbnail_path])
			->andFilterWhere(['like', 'coin', $this->coin])
			->andFilterWhere(['like', 'game_web_url', $this->game_web_url])
			->andFilterWhere(['like', 'game_bbs_url', $this->game_bbs_url])
			->andFilterWhere(['like', 'api_secret', $this->api_secret])
			->andFilterWhere(['like', 'api_server', $this->api_server])
			->andFilterWhere(['like', 'api_play', $this->api_play])
			->andFilterWhere(['like', 'api_pay', $this->api_pay])
			->andFilterWhere(['like', 'api_check', $this->api_check])
			->andFilterWhere(['like', 'api_order', $this->api_order])
			->andFilterWhere(['like', 'slug', $this->slug]);



		return $dataProvider;
	}
}
