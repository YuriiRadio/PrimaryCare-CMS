<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "docrors_categories_i18n".
 *
 * @property string $id
 * @property string $parent_table_id
 * @property string $language
 * @property string $name
 */
class DoctorCategoryI18n extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_categories_i18n';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['parent_table_id', 'language', 'name'], 'required'],
            [['language', 'name'], 'required'],
            [['parent_table_id'], 'integer'],
            [['language'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('lang', 'ID'),
            'parent_table_id' => Yii::t('lang', 'Parent Table ID'),
            'language' => Yii::t('lang', 'Language'),
            'name' => Yii::t('lang', 'Name'),
        ];
    }
}
