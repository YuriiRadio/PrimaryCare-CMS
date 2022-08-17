<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\Doctor;

/**
 * This is the model class for table "patients".
 *
 * @property int $id
 * @property int $status
 * @property int $doctor_id
 * @property string $declaration_number
 * @property string $name
 * @property string $birth
 * @property int $sex
 * @property string $address
 * @property string $email
 * @property int $created_at
 * @property int $updated_at
 */
class Patients extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const FEMALE = 0;
    const MALE = 1;
    const IT = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'doctor_id', 'declaration_number', 'name', 'birth', 'sex'], 'required'],
            [['status', 'doctor_id', 'sex', 'created_at', 'updated_at'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            ['sex', 'in', 'range' => [self::FEMALE, self::MALE, self::IT]],
            ['birth', 'date', 'format' => 'php:Y-m-d'],
            [['name', 'address', 'email'], 'trim'],
            [['declaration_number'], 'string', 'max' => 14],
            [['declaration_number'], 'unique'],
            [['name', 'address'], 'string', 'max' => 255],
            [['address', 'email'], 'default', 'value' => null],
            [['email'], 'string', 'max' => 100],
            ['email', 'email'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor() {
        return $this->hasOne(Doctor::className(), ['id' => 'doctor_id']);
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
                // если вместо метки времени UNIX используется datetime:
//                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('lang', 'ID'),
            'status' => Yii::t('lang', 'Status'),
            'doctor_id' => Yii::t('lang', 'Doctor'),
            'declaration_number' => Yii::t('lang', 'Declaration number'),
            'name' => Yii::t('lang', 'Name'),
            'birth' => Yii::t('lang', 'Birth'),
            'sex' => Yii::t('lang', 'Sex'),
            'address' => Yii::t('lang', 'Address'),
            'email' => Yii::t('lang', 'Email'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            #---------------------------------------------------------------
            'doctor.name' => Yii::t('lang', 'Doctor name'),
        ];
    }
}
