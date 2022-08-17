<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Patients;

/**
 * PatientsSearch represents the model behind the search form of `app\models\Patients`.
 */
class PatientsSearch extends Patients
{
    public $doctor;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'doctor_id', 'sex'], 'integer'],
            [['declaration_number', 'name', 'address', 'email', 'created_at', 'updated_at', 'doctor'], 'safe'],
            ['birth', 'string', 'max' => 10],
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
        # SELECT `patients`.* ,`doctors_i18n`.`name` FROM `patients` LEFT JOIN `doctors` ON `patients`.`doctor_id` = `doctors`.`id` LEFT JOIN `doctors_i18n` ON `doctors_i18n`.`parent_table_id` = `doctors`.`id` WHERE (`language` = 'uk-UA') LIMIT 20;
//        $query = Patients::find()->join('LEFT JOIN', 'doctors', '`patients`.`doctor_id` = `doctors`.`id` LEFT JOIN `doctors_i18n` ON `doctors_i18n`.`parent_table_id` = `doctors`.`id`')->select(['`patients`.*','`doctors_i18n`.`name` AS doctor']);
        $query = Patients::find();

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
            'doctor_id' => $this->doctor_id,
//            'birth' => $this->birth,
            'sex' => $this->sex,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'declaration_number', $this->declaration_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
//            ->andFilterWhere(['like', 'language', Yii::$app->language])
            ->andFilterWhere(['like', 'email', $this->email]);


        if ($this->birth) {
            $query->andFilterWhere(['birth' => date('Y-m-d', strtotime($this->birth))]);
        }

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
