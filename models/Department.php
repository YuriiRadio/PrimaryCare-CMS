<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
//use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "departments".
 *
 * @property string $id
 * @property string $alias
 * @property string $parent_id
 * @property string $created_at
 * @property string $updated_at
 */
class Department extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    public function getI18n() {
        return $this->hasOne(DepartmentI18n::className(), ['parent_table_id' => 'id'])
            ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getName() {
        return $this->i18n->name;
    }

    public function getStreet() {
        return $this->i18n->street;
    }

    public function getBody() {
        return $this->i18n->body;
    }

    public function getParent() {
        return $this->hasOne(Department::className(), ['id' => 'parent_id']);
    }

    public function getRegion() {
        return $this->hasOne(RegionI18n::className(), ['parent_table_id' => 'region_id'])
            ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getDepartmentType() {
        return $this->hasOne(DepartmentTypeI18n::className(), ['parent_table_id' => 'department_type_id'])
            ->where('language = :language', [':language' => Yii::$app->language]);
    }
    
    public function getDoctors() {
        return $this->hasMany(Doctor::className(), ['department_id' => 'id'])
                ->where('status = :status', [':status' => Doctor::STATUS_ACTIVE]);
    }

    public static function getParentsList() {
        // Вибираємо ті категорії в яких є дочірні
        $parents = Department::find()
            ->select(['departments.id', 'departments_i18n.name'])
            ->join('JOIN', 'departments_i18n', 'departments_i18n.parent_table_id = departments.id')
            ->join('JOIN', 'departments a', 'a.parent_id = departments.id')
            ->where('departments_i18n.language = :language', [':language' => Yii::$app->language])
            ->distinct(true)
            ->all();

        return \yii\helpers\ArrayHelper::map($parents, 'id', 'name');
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
//            [
//                'class' => SluggableBehavior::className(),
//                'attribute' => 'name',
//                'slugAttribute' => 'alias',
//                'immutable' => true,
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'required'],
            [['parent_id', 'department_type_id', 'region_id', 'created_at', 'updated_at'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['alias'], 'string', 'max' => 255],
            ['phone', 'string', 'max' => 20],
            ['email', 'email'],
            [['zip_code'], 'integer'],
            [['alias'], 'unique'],
            ['building', 'string', 'max' => 20],
            [['latitude', 'longitude'], 'double'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('lang', 'ID'),
            'status' => Yii::t('lang', 'Status'),
            'department_type_id' => Yii::t('lang', 'Department type'),
            'region_id' => Yii::t('lang', 'Region'),
            'alias' => Yii::t('lang', 'Alias'),
            'phone' => Yii::t('lang', 'Phone'),
            'email' => Yii::t('lang', 'Email'),
            'zip_code' => Yii::t('lang', 'ZIP Code'),
            'building' => Yii::t('lang', 'Building'),
            'latitude' => Yii::t('lang', 'Latitude'),
            'longitude' => Yii::t('lang', 'Longitude'),
            'parent_id' => Yii::t('lang', 'Category'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            //**************************************************
            'name' => Yii::t('lang', 'Category Name'),
            'street' => Yii::t('lang', 'Street'),
            'body' => Yii::t('lang', 'Text'),
        ];
    }
}
