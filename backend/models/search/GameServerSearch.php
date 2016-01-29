<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GameServer;

/**
 * GameServerSearch represents the model behind the search form about `common\models\GameServer`.
 */
class GameServerSearch extends GameServer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'server_id', 'game_id', 'start_time', 'is_new', 'is_hot', 'is_recommend', 'is_shutdown', 'created_at', 'updated_at', 'status'], 'integer'],
            [['server_name', 'server_key', 'slug'], 'safe'],
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
        $query = GameServer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'server_id' => $this->server_id,
            'game_id' => $this->game_id,
            'start_time' => $this->start_time,
            'is_new' => $this->is_new,
            'is_hot' => $this->is_hot,
            'is_recommend' => $this->is_recommend,
            'is_shutdown' => $this->is_shutdown,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'server_name', $this->server_name])
            ->andFilterWhere(['like', 'server_key', $this->server_key])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
