<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderDetails;

/**
 * OrderDetailsSearch represents the model behind the search form about `common\models\OrderDetails`.
 */
class OrderDetailsSearch extends OrderDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'product_id', 'category_id'], 'integer'],
            [['product_code', 'product_image', 'product_ref', 'note', 'tracking_status', 'order_date', 'status', 'created_at', 'updated_at'], 'safe'],
            [['unit_price', 'tax_value', 'discount', 'weight', 'extra_number', 'extra_percent', 'extra_lbs'], 'number'],
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
        $query = OrderDetails::find()->visible();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'unit_price' => $this->unit_price,
//            'quantity' => $this->quantity,
            'tax_value' => $this->tax_value,
            'discount' => $this->discount,
            'weight' => $this->weight,
            'category_id' => $this->category_id,
            'extra_number' => $this->extra_number,
            'extra_percent' => $this->extra_percent,
            'extra_lbs' => $this->extra_lbs,
//            'total_price' => $this->total_price,
            'order_date' => $this->order_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'product_image', $this->product_image])
            ->andFilterWhere(['like', 'product_ref', $this->product_ref])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'tracking_status', $this->tracking_status])
            ->andFilterWhere(['like', 'status', $this->status]);


        return $dataProvider;
    }
}
