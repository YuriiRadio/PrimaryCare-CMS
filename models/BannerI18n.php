<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banners_i18n".
 *
 * @property $id int(10)
 * @property $parent_table_id int(10)
 * @property $language varchar(5)
 * @property $name varchar(255)

 */
class BannerI18n extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners_i18n';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'language'], 'required'],
            [['parent_table_id'], 'integer'],
            [['language'], 'string', 'max' => 5],
            ['name', 'string', 'max' => 255],
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
