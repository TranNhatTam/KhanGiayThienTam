<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'brand_id', 'discount', 'star_rating', 'total_view', 'group_id', 'unit_in_stock', 'quantity_in_stock', 'suppiler_id'], 'integer'],
            [['name', 'status', 'description', 'short_detail', 'warranty', 'technical_detail', 'additional_detail', 'product_ref'], 'safe'],
            [['unit_price'], 'number'],
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
        $query = Product::find()->visible()->orderBy(['priority'=>SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'unit_price' => $this->unit_price,
            'discount' => $this->discount,
            'star_rating' => $this->star_rating,
            'total_view' => $this->total_view,
            'group_id' => $this->group_id,
            'unit_in_stock' => $this->unit_in_stock,
            'quantity_in_stock' => $this->quantity_in_stock,
            'suppiler_id' => $this->suppiler_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'short_detail', $this->short_detail])
            ->andFilterWhere(['like', 'warranty', $this->warranty])
            ->andFilterWhere(['like', 'technical_detail', $this->technical_detail])
            ->andFilterWhere(['like', 'additional_detail', $this->additional_detail])
            ->andFilterWhere(['like', 'product_ref', $this->product_ref]);

        return $dataProvider;
    }
}
