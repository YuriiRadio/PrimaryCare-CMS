<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments_i18n".
 *
 * @property string $id
 * @property string $aticle_category_id
 * @property string $language
 * @property string $name

 */
class DepartmentI18n extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments_i18n';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['aticle_category_id', 'language', 'name'], 'required'],
            [['name'], 'required'],
            [['parent_table_id'], 'integer'],
            [['language'], 'string', 'max' => 5],
            [['name', 'street'], 'string', 'max' => 255],
            [['body'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('lang', 'ID'),
            'aticle_category_id' => Yii::t('lang', 'Aticle Category ID'),
            'language' => Yii::t('lang', 'Language'),
            'name' => Yii::t('lang', 'Name'),
            'street' => Yii::t('lang', 'Street'),
            'body' => Yii::t('lang', 'Text'),
        ];
    }
}
