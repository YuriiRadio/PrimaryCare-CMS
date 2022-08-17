<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnalysesCategories;

/**
 * AnalysesCategoriesSearch represents the model behind the search form of `app\models\AnalysesCategories`.
 */
class AnalysesCategoriesSearch extends AnalysesCategories
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['created_at', 'updated_at', 'title'], 'string'],
            [['created_at', 'updated_at'], 'string', 'max' => 10],
            [['created_at', 'updated_at', 'title'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = AnalysesCategories::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        //        $date = date('Y-m-d', strtotime($order->date) + 86400);
        if ($this->created_at) {
            $query->andFilterWhere(['between', 'created_at',
                strtotime($this->created_at), strtotime($this->created_at) + 86400]);
        }

        if ($this->updated_at) {
            $query->andFilterWhere(['between', 'updated_at',
                strtotime($this->updated_at), strtotime($this->updated_at) + 86400]);
        }

        return $dataProvider;
    }
}
