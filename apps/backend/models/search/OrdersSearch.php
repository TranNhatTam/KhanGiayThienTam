<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `common\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'employee_id', 'shipper_id', 'status', 'ship_status', 'payment_status', 'payment_type', 'notification_type', 'is_deleted'], 'integer'],
            [['order_date', 'ship_date', 'fee_info', 'billing_info', 'payment_info', 'ship_name', 'ship_phone', 'ship_email', 'ship_address', 'ship_city', 'ship_district', 'ship_ward', 'ship_postcode', 'ship_country', 'note', 'created_at', 'updated_at'], 'safe'],
            [['freight', 'total_price', 'total_tax'], 'number'],
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
        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'employee_id' => $this->employee_id,
            'order_date' => $this->order_date,
            'ship_date' => $this->ship_date,
            'shipper_id' => $this->shipper_id,
            'freight' => $this->freight,
            'total_price' => $this->total_price,
            'total_tax' => $this->total_tax,
            'status' => $this->status,
            'ship_status' => $this->ship_status,
            'payment_status' => $this->payment_status,
            'payment_type' => $this->payment_type,
            'notification_type' => $this->notification_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'fee_info', $this->fee_info])
            ->andFilterWhere(['like', 'billing_info', $this->billing_info])
            ->andFilterWhere(['like', 'payment_info', $this->payment_info])
            ->andFilterWhere(['like', 'ship_name', $this->ship_name])
            ->andFilterWhere(['like', 'ship_phone', $this->ship_phone])
            ->andFilterWhere(['like', 'ship_email', $this->ship_email])
            ->andFilterWhere(['like', 'ship_address', $this->ship_address])
            ->andFilterWhere(['like', 'ship_city', $this->ship_city])
            ->andFilterWhere(['like', 'ship_district', $this->ship_district])
            ->andFilterWhere(['like', 'ship_ward', $this->ship_ward])
            ->andFilterWhere(['like', 'ship_postcode', $this->ship_postcode])
            ->andFilterWhere(['like', 'ship_country', $this->ship_country])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
