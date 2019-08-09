<?php

namespace backend\models;

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
            [['id', 'customer_id', 'employee_id', 'shiper_id', 'payment_type', 'notification_type','ship_status','payment_status'], 'integer'],
            [['order_date', 'require_date', 'ship_date', 'ship_name', 'ship_phone', 'ship_email', 'ship_address', 'ship_city', 'ship_district', 'ship_ward', 'ship_postalcode', 'ship_country', 'status', 'note'], 'safe'],
            [['freight', 'total_price'], 'number'],
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
        $query = Orders::find()->visible()->orderBy(['id'=>SORT_DESC]);

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
            'require_date' => $this->require_date,
            'ship_date' => $this->ship_date,
            'shiper_id' => $this->shiper_id,
            'freight' => $this->freight,
            'total_price' => $this->total_price,
            'payment_type' => $this->payment_type,
            'notification_type' => $this->notification_type,
            'ship_status' => $this->ship_status,
            'payment_status' => $this->payment_status,
        ]);

        $query->andFilterWhere(['like', 'ship_name', $this->ship_name])
            ->andFilterWhere(['like', 'ship_phone', $this->ship_phone])
            ->andFilterWhere(['like', 'ship_email', $this->ship_email])
            ->andFilterWhere(['like', 'ship_address', $this->ship_address])
            ->andFilterWhere(['like', 'ship_city', $this->ship_city])
            ->andFilterWhere(['like', 'ship_district', $this->ship_district])
            ->andFilterWhere(['like', 'ship_ward', $this->ship_ward])
            ->andFilterWhere(['like', 'ship_postalcode', $this->ship_postalcode])
            ->andFilterWhere(['like', 'ship_country', $this->ship_country])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
