<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Doctor;

/**
 * DoctorSearch represents the model behind the search form of `app\models\Doctor`.
 */
class DoctorSearch extends Doctor
{
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doctor_specialization_id', 'doctor_category_id', 'department_id', 'experience', 'views', 'created_at', 'updated_at'], 'integer'],
            [['status', 'email', 'phone'], 'safe'],
            ['name', 'string', 'max' => 255],
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
        //$query = Doctor::find();
        $query = Doctor::find()->joinWith('i18n');

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
            'doctor_specialization_id' => $this->doctor_specialization_id,
            'doctor_category_id' => $this->doctor_category_id,
            'department_id' => $this->department_id,
            'experience' => $this->experience,
            'views' => $this->views,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
