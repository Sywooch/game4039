<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KefuAccountRepair;

/**
 * KefuAccountRepairSearch represents the model behind the search form about `common\models\KefuAccountRepair`.
 */
class KefuAccountRepairSearch extends KefuAccountRepair
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reason', 'register_time', 'security_question_one', 'security_question_two', 'created_at', 'updated_at', 'progress', 'status'], 'integer'],
            [['sn', 'account', 'register_place', 'recent_games', 'question_desc', 'bind_email', 'security_question_one_answer', 'security_question_two_answer', 'applicant_name', 'applicant_phone', 'applicant_identity', 'applicant_email', 'identity_front_base_url', 'identity_front_path', 'identity_back_base_url', 'identity_back_path'], 'safe'],
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
        $query = KefuAccountRepair::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'reason' => $this->reason,
            'register_time' => $this->register_time,
            'security_question_one' => $this->security_question_one,
            'security_question_two' => $this->security_question_two,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'progress' => $this->progress,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'sn', $this->sn])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'register_place', $this->register_place])
            ->andFilterWhere(['like', 'recent_games', $this->recent_games])
            ->andFilterWhere(['like', 'question_desc', $this->question_desc])
            ->andFilterWhere(['like', 'bind_email', $this->bind_email])
            ->andFilterWhere(['like', 'security_question_one_answer', $this->security_question_one_answer])
            ->andFilterWhere(['like', 'security_question_two_answer', $this->security_question_two_answer])
            ->andFilterWhere(['like', 'applicant_name', $this->applicant_name])
            ->andFilterWhere(['like', 'applicant_phone', $this->applicant_phone])
            ->andFilterWhere(['like', 'applicant_identity', $this->applicant_identity])
            ->andFilterWhere(['like', 'applicant_email', $this->applicant_email])
            ->andFilterWhere(['like', 'identity_front_base_url', $this->identity_front_base_url])
            ->andFilterWhere(['like', 'identity_front_path', $this->identity_front_path])
            ->andFilterWhere(['like', 'identity_back_base_url', $this->identity_back_base_url])
            ->andFilterWhere(['like', 'identity_back_path', $this->identity_back_path]);

        return $dataProvider;
    }
}
