<?php

namespace backend\models\search;

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
            [['id', 'unit_in_stock', 'quantity_in_stock', 'star_rating', 'total_view', 'status', 'priority', 'is_deleted', 'brand_id', 'category_id', 'url_id'], 'integer'],
            [['name', 'thumbnail_path', 'thumbnail_base_url', 'warranty', 'short_detail', 'description', 'technical_detail', 'additional_detail', 'created_at', 'updated_at', 'images'], 'safe'],
            [['unit_price', 'discount'], 'number'],
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
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'unit_price' => $this->unit_price,
            'unit_in_stock' => $this->unit_in_stock,
            'quantity_in_stock' => $this->quantity_in_stock,
            'discount' => $this->discount,
            'star_rating' => $this->star_rating,
            'total_view' => $this->total_view,
            'status' => $this->status,
            'priority' => $this->priority,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
            'brand_id' => $this->brand_id,
            'category_id' => $this->category_id,
            'url_id' => $this->url_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'thumbnail_path', $this->thumbnail_path])
            ->andFilterWhere(['like', 'thumbnail_base_url', $this->thumbnail_base_url])
            ->andFilterWhere(['like', 'warranty', $this->warranty])
            ->andFilterWhere(['like', 'short_detail', $this->short_detail])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'technical_detail', $this->technical_detail])
            ->andFilterWhere(['like', 'additional_detail', $this->additional_detail])
            ->andFilterWhere(['like', 'images', $this->images]);

        return $dataProvider;
    }
}
