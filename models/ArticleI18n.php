<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles_i18n".
 *
 * @property string $id
 * @property string $parent_table_id
 * @property string $language
 * @property string $title
 * @property string $body
 * @property string $keywords
 * @property string $description
 */
class ArticleI18n extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles_i18n';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['aticle_id', 'language', 'title'], 'required'],
            [['language', 'title'], 'required'],
            [['parent_table_id'], 'integer'],
            [['body'], 'string'],
            [['language'], 'string', 'max' => 5],
            [['title', 'keywords', 'description'], 'string', 'max' => 255],
            ['parent_table_id', 'safe']
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
            'title' => Yii::t('lang', 'Title'),
            'body' => Yii::t('lang', 'Body'),
            'keywords' => Yii::t('lang', 'Keywords'),
            'description' => Yii::t('lang', 'Description'),
        ];
    }
}
