<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/29
 * Time: 14:43
 * Desc:
 */

namespace frontend\models\search;


use common\models\Activity;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ActivitySearch extends Activity
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'category_id', 'start_time', 'end_time', 'created_at', 'updated_at', 'status'], 'integer'],
			[['title', 'description', 'url', 'thumbnail_base_url', 'thumbnail_path', 'content', 'slug'], 'safe'],
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
		$query = Activity::find()->statusInUse();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'category_id' => $this->category_id,
			'start_time' => $this->start_time,
			'end_time' => $this->end_time,
			'status' => $this->status,
		]);

		$query->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'description', $this->description])
			->andFilterWhere(['like', 'url', $this->url])
			->andFilterWhere(['like', 'content', $this->content])
			->andFilterWhere(['like', 'slug', $this->slug]);

		return $dataProvider;
	}

}