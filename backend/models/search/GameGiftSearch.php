<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GameGift;

/**
 * GameGiftSearch represents the model behind the search form about `common\models\GameGift`.
 */
class GameGiftSearch extends GameGift
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'game_id', 'game_server_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['lb_gid', 'lb_name', 'lb_type', 'lb_method', 'lb_content', 'slug'], 'safe'],
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
        $query = GameGift::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'game_id' => $this->game_id,
            'game_server_id' => $this->game_server_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'lb_gid', $this->lb_gid])
            ->andFilterWhere(['like', 'lb_name', $this->lb_name])
            ->andFilterWhere(['like', 'lb_type', $this->lb_type])
            ->andFilterWhere(['like', 'lb_method', $this->lb_method])
            ->andFilterWhere(['like', 'lb_content', $this->lb_content])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
