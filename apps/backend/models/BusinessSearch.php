<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Business;

/**
 * BusinessSearch represents the model behind the search form about `common\models\Business`.
 */
class BusinessSearch extends Business
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['phone', 'thumbnail_base_url', 'thumbnail_path', 'name', 'phone', 'hot_line', 'link_skype', 'link_google_plus', 'link_facebook'], 'safe'],
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
        $query = Business::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'hot_line', $this->hot_line])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link_google_plus', $this->link_google_plus])
            ->andFilterWhere(['like', 'link_facebook', $this->link_facebook])
            ->andFilterWhere(['like', 'link_skype', $this->link_skype])
            ->andFilterWhere(['like', 'thumbnail_base_url', $this->thumbnail_base_url])
            ->andFilterWhere(['like', 'thumbnail_path', $this->thumbnail_path]);

        return $dataProvider;
    }
}
