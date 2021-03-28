<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "static_pages_i18n".
 *
 * @property string $id
 * @property string $static_page_id
 * @property string $language
 * @property string $title
 * @property string $body
 */
class StaticPageI18n extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_pages_i18n';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['static_page_id', 'language', 'title', 'body'], 'required'],
            [['language', 'title', 'body'], 'required'],
            [['static_page_id'], 'integer'],
            [['body'], 'string'],
            [['language'], 'string', 'max' => 5],
            [['title', 'keywords', 'description'], 'string', 'max' => 255],
            [['keywords', 'description', 'static_page_id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('lang', 'ID'),
            'static_page_id' => Yii::t('lang', 'Static Page ID'),
            'language' => Yii::t('lang', 'Language'),
            'title' => Yii::t('lang', 'Title'),
            'body' => Yii::t('lang', 'Body'),
            'keywords' => Yii::t('lang', 'Keywords'),
            'description' => Yii::t('lang', 'Description'),
        ];
    }
}
