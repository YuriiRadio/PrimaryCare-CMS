<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Analyses;

/**
 * AnalysesSearch represents the model behind the search form of `app\models\Analyses`.
 */
class AnalysesSearch extends Analyses {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'status', 'is_free', 'department_id'], 'integer'],
            [['title', 'pac_num', 'device', 'created_at', 'updated_at'], 'safe'],
            ['units', 'string'],
            [['units', 'pac_num', 'device'], 'trim'],
            [['cost'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Analyses::find();

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
            'is_free' => $this->is_free,
//            'cost' => $this->analys_cost,
            'department_id' => $this->department_id,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'pac_num', $this->pac_num])
                ->andFilterWhere(['like', 'units', $this->units])
                ->andFilterWhere(['like', 'device', $this->device]);

//        if ($this->cost) {
            $query->andFilterWhere(['<=', 'cost', $this->cost]);
//        }

//        $date = date('Y-m-d', strtotime($order->date) + 86400);
        if ($this->created_at) {
            $query->andFilterWhere(['between', 'created_at',
                strtotime($this->created_at), strtotime($this->created_at) + 86400]);
        }

        if ($this->updated_at) {
            $query->andFilterWhere(['between', 'created_at',
                strtotime($this->updated_at), strtotime($this->updated_at) + 86400]);
        }

        return $dataProvider;
    }
}
