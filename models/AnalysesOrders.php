<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "analyses_orders".
 *
 * @property int $id
 * @property int $status
 * @property int $doctor_id
 * @property int $patient_id
 * @property string $analyses_packages_ids (varchar(255))
 * @property int $date_biomaterial int(10) (timestamp)
 * @property string $analyses_values (text)
 * @property int $views
 * @property int $created_at
 * @property int $updated_at
 */
class AnalysesOrders extends ActiveRecord {

    const STATUS_NEW = 0;
    const STATUS_EDITED = 1;
    const STATUS_DONE = 2;

//    public $analyses_elements;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'analyses_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['status', 'doctor_id', 'patient_id', 'views', 'created_at', 'updated_at'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_NEW, self::STATUS_EDITED, self::STATUS_DONE]],
            [['analyses_packages_ids'], 'string', 'max' => 255],
            [['analyses_values'], 'string'],
            [['analyses_packages_ids', 'analyses_values'], 'trim'],
            [['status', 'doctor_id', 'patient_id', 'analyses_packages_ids'], 'required'],
            [['views', 'created_at', 'updated_at', 'date_biomaterial'], 'safe'],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctor::className(), 'targetAttribute' => ['doctor_id' => 'id']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patients::className(), 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor() {
        return $this->hasOne(Doctor::className(), ['id' => 'doctor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient() {
        return $this->hasOne(Patients::className(), ['id' => 'patient_id']);
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

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {

            #Виконувальний код
            $this->date_biomaterial = strtotime($this->date_biomaterial);
            #End Виконувальний код

            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('lang', 'ID'),
            'status' => Yii::t('lang', 'Status'),
            'doctor_id' => Yii::t('lang', 'Doctor'),
            'patient_id' => Yii::t('lang', 'Patient'),
            'analyses_packages_ids' => Yii::t('lang', 'Analyses packages ids'),
            'date_biomaterial' => Yii::t('lang', 'Date of biomaterial'),
            'analyses_values' => Yii::t('lang', 'Analyses values'),
            'views' => Yii::t('lang', 'Views'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
        ];
    }

}
