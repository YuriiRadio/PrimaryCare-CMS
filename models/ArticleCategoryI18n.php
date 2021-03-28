<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_categories_i18n".
 *
 * @property string $id
 * @property string $parent_table_id
 * @property string $language
 * @property string $name
 * @property string $keywords
 * @property string $description
 */
class ArticleCategoryI18n extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_categories_i18n';
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
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
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
            'keywords' => Yii::t('lang', 'Keywords'),
            'description' => Yii::t('lang', 'Description'),
        ];
    }
}
