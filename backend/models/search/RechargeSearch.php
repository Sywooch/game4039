<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Recharge;

/**
 * RechargeSearch represents the model behind the search form about `common\models\Recharge`.
 */
class RechargeSearch extends Recharge
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'game_id', 'server_id', 'created_at', 'status'], 'integer'],
            [['role_id', 'order_id'], 'safe'],
            [['amount'], 'number'],
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
        $query = Recharge::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'game_id' => $this->game_id,
            'server_id' => $this->server_id,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'role_id', $this->role_id])
            ->andFilterWhere(['like', 'order_id', $this->order_id]);

        return $dataProvider;
    }
}
