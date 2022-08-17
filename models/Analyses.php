<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
//use yii\db\Expression;
use app\models\Department;

/**
 * This is the model class for table "analyses_types".
 *
 * @property int $id
 * @property int $status
 * @property int $analyses_categories_id
 * @property string $pac_num: varchar(12)
 * @property int $is_free: unsigned tinyint(1) (no money)
 * @property string $title
 * @property string $units: varchar(255)
 * @property string $norm
 * @property double $cost
 * @property string $device
 * @property int $department_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Departments $department
 */
class Analyses extends ActiveRecord {

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'analyses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['status', 'analyses_categories_id', 'is_free', 'department_id'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['title', 'analyses_categories_id', 'pac_num', 'is_free'], 'required'],
            [['title'], 'unique'],
            [['pac_num', 'units', 'norm'], 'string'],
            [['cost'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['pac_num'], 'string', 'max' => 12],
            [['title'], 'string', 'max' => 255],
            [['units'], 'string', 'max' => 255],
            [['device'], 'string', 'max' => 150],
            [['title', 'pac_num', 'units', 'norm'], 'trim'],
            [['created_at', 'updated_at'], 'safe'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(AnalysesCategories::className(), ['id' => 'analyses_categories_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment() {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
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
    public function attributeLabels() {
        return [
            'id' => Yii::t('lang', 'ID'),
            'status' => Yii::t('lang', 'Status'),
            'analyses_categories_id' => Yii::t('lang', 'Category analyses'),
            'pac_num' => Yii::t('lang', 'Package number'),
            'is_free' => Yii::t('lang', 'Is free'),
            'title' => Yii::t('lang', 'Title'),
            'units' => Yii::t('lang', 'Units'),
            'norm' => Yii::t('lang', 'Normal'),
            'cost' => Yii::t('lang', 'Analys cost'),
            'device' => Yii::t('lang', 'Device'),
            'department_id' => Yii::t('lang', 'Department'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            #----------------------------------------------------------------
            'category.title' => Yii::t('lang', 'Category'),
        ];
    }

        /**
     * {@inheritdoc}
     */
    public function hints()
    {
        return array_merge(parent::hints(), [
            'is_free' => 'Аналіз для пацієнтів центру безкоштовний',
            'db' => 'This is the ID of the DB application component.',
        ]);
    }

}
