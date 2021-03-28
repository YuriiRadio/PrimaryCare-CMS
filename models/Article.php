<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "articles".
 *
 * @property string $id
 * @property int $status
 * @property string $category_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $views
 * @property string $og_image varchar(255)
 */
class Article extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    public function getI18n() {
        return $this->hasOne(ArticleI18n::className(), ['parent_table_id' => 'id'])
            ->where('language = :language', [':language' => Yii::$app->language]);
    }

    /**
     * @inheritdoc
     */
    public function getArticleCategory() {
        return $this->hasOne(ArticleCategory::ClassName(), ['id' => 'category_id']);
    }

    public function getTitle() {
        return $this->i18n->title;
    }

    public function getBody() {
        return $this->i18n->body;
    }

    public function getKeywords() {
        return $this->i18n->keywords;
    }

    public function getDescription() {
        return $this->i18n->description;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['category_id', 'created_at', 'updated_at'], 'required'],
            [['alias'], 'required'],
            [['alias'], 'unique'],
            [['alias', 'og_image'], 'trim'],
            ['og_image', 'string', 'max' => 255],
            [['category_id', 'created_at', 'updated_at', 'views'], 'integer'],
            [['status'], 'string', 'max' => 1],
            [['created_at', 'updated_at'], 'safe']
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
            'alias' => Yii::t('lang', 'Alias'),
            'category_id' => Yii::t('lang', 'Category'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            'views' => Yii::t('lang', 'Views'),
            'og_image' => Yii::t('lang', 'og:image'),
            //**********************************************
            'title' => Yii::t('lang', 'Title'),
            'body' => Yii::t('lang', 'Body'),
            'keywords' => Yii::t('lang', 'Keywords'),
            'description' => Yii::t('lang', 'Description'),
        ];
    }
}
