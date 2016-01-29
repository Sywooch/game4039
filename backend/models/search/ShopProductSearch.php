<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ShopProduct;

/**
 * ShopProductSearch represents the model behind the search form about `common\models\ShopProduct`.
 */
class ShopProductSearch extends ShopProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'jifen', 'product_number', 'return_jifen', 'is_on_sale', 'is_delete', 'is_hot', 'is_promote', 'is_check', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title', 'slug', 'description', 'content', 'keywords', 'thumbnail_base_url', 'thumbnail_path', 'img_base_url', 'img_path'], 'safe'],
            [['price'], 'number'],
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
        $query = ShopProduct::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'jifen' => $this->jifen,
            'product_number' => $this->product_number,
            'return_jifen' => $this->return_jifen,
            'is_on_sale' => $this->is_on_sale,
            'is_delete' => $this->is_delete,
            'is_hot' => $this->is_hot,
            'is_promote' => $this->is_promote,
            'is_check' => $this->is_check,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'thumbnail_base_url', $this->thumbnail_base_url])
            ->andFilterWhere(['like', 'thumbnail_path', $this->thumbnail_path])
            ->andFilterWhere(['like', 'img_base_url', $this->img_base_url])
            ->andFilterWhere(['like', 'img_path', $this->img_path]);

        return $dataProvider;
    }
}
