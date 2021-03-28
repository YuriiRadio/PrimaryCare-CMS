<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "departments_types".
 *
 * @property string $id
 * @property string $created_at
 * @property string $updated_at
 */
class DepartmentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department_types';
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            //[['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function getI18n() {
        return $this->hasOne(DepartmentTypeI18n::className(), ['parent_table_id' => 'id'])
            ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getName() {
        return $this->i18n->name;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('lang', 'ID'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            //**************************************************
            'name' => Yii::t('lang', 'Category Name'),
        ];
    }
}
