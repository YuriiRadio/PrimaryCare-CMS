<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "analyses_packages".
 *
 * @property int $id
 * @property int $status
 * @property int $is_free
 * @property string $pac_num
 * @property string $title
 * @property string $analyses_ids
 * @property float|null $cost
 * @property int $created_at
 * @property int $updated_at
 */
class AnalysesPackages extends ActiveRecord {

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'analyses_packages';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['status', 'is_free', 'pac_num', 'title', 'analyses_ids'], 'required'],
            [['status', 'is_free', 'created_at', 'updated_at'], 'integer'],
            [['cost'], 'number'],
            [['pac_num'], 'string', 'max' => 5],
            [['title', 'analyses_ids'], 'string', 'max' => 255],
            [['pac_num'], 'unique'],
            [['pac_num', 'title', 'analyses_ids'], 'trim'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('lang', 'ID'),
            'status' => Yii::t('lang', 'Status'),
            'is_free' => Yii::t('lang', 'Is Free'),
            'pac_num' => Yii::t('lang', 'Package number'),
            'title' => Yii::t('lang', 'Title'),
            'analyses_ids' => Yii::t('lang', 'Analyses Ids'),
            'cost' => Yii::t('lang', 'Cost'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
        ];
    }

}
