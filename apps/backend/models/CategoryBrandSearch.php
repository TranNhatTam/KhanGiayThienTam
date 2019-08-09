<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CategoryBrand;

/**
 * CategoryBrandSearch represents the model behind the search form about `common\models\CategoryBrand`.
 */
class CategoryBrandSearch extends CategoryBrand
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'brand_id'], 'integer'],
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
        $query = CategoryBrand::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
        ]);

        return $dataProvider;
    }
}
