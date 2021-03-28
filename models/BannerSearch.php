<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Banner;

/**
 * BannerSearch represents the model behind the search form of `app\models\Doctor`.
 */
class BannerSearch extends Banner
{
    public $name;
    public $to_date_normal_created;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'to_date', 'clicks', 'created_at', 'updated_at'], 'integer'],
            [['to_date_normal', 'name', 'to_date_normal_created'], 'filter', 'filter' => 'trim'],
            [['name', 'position'], 'string', 'max' => 255],
            [['to_date_normal_created'], 'date', 'format' => 'php:d.m.Y'],
            //[['status', 'end_time_show_normal'], 'safe'],
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
        $query = Banner::find()->joinWith('i18n');

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
            Banner::tableName().'.id' => $this->id,
            'status' => $this->status,
            'position' => $this->position,
            'clicks' => $this->clicks,
            //'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        if ($this->to_date_normal) {
            $query->andFilterWhere(['between', 'to_date',
                strtotime($this->to_date_normal), strtotime($this->to_date_normal) + 86400]);
        }

        if ($this->to_date_normal_created) {
            $query->andFilterWhere(['between', 'created_at',
                strtotime($this->to_date_normal_created), strtotime($this->to_date_normal_created) + 86400]);
        }

        return $dataProvider;
    }

}