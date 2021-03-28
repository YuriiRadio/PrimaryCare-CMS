<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctors_i18n".
 *
 * @property string $id
 * @property string $parent_table_id
 * @property string $name
 * @property string $institute
 */
class DoctorI18n extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors_i18n';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['parent_table_id', 'name', 'institute'], 'required'],
            [['name', 'institute'], 'required'],
            [['parent_table_id'], 'integer'],
            [['name', 'institute'], 'string', 'max' => 255],
            ['body', 'string'],
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
            'name' => Yii::t('lang', 'Name'),
            'institute' => Yii::t('lang', 'Institute'),
        ];
    }
}
