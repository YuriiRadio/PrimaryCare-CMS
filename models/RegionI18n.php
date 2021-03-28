<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regions_i18n".
 *
 * @property string $id
 * @property string $aticle_category_id
 * @property string $language
 * @property string $name

 */
class RegionI18n extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regions_i18n';
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
