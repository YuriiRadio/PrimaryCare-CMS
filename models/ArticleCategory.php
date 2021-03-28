<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
//use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "article_categories".
 *
 * @property int(10) $id
 * @property tinyint(1) $status
 * @property varchar(255) $alias
 * @property int(10) $parent_id
 * @property int(10) $created_at
 * @property int(10) $updated_at
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_categories';
    }

    public function getI18n() {
        return $this->hasOne(ArticleCategoryI18n::className(), ['parent_table_id' => 'id'])
            ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getName() {
        return $this->i18n->name;
    }

    public function getKeywords() {
        return $this->i18n->keywords;
    }

    public function getDescription() {
        return $this->i18n->description;
    }

    public function getArticles() {
        return $this->hasMany(Article::ClassName(), ['category_id' => 'id']);
    }

    public function getParentCategory() {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'parent_id']);
    }

    public static function getParentsList() {
        // Вибираємо ті категорії в яких є дочірні
        $parents = ArticleCategory::find()
            ->select(['article_categories.id', 'article_categories_i18n.name'])
            ->join('JOIN', 'article_categories_i18n', 'article_categories_i18n.parent_table_id = article_categories.id')
            ->join('JOIN', 'article_categories a', 'a.parent_id = article_categories.id')
            ->where('article_categories_i18n.language = :language', [':language' => Yii::$app->language])
            ->distinct(true)
            ->all();

        return \yii\helpers\ArrayHelper::map($parents, 'id', 'name');
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
//            [
//                'class' => SluggableBehavior::className(),
//                'attribute' => 'name',
//                'slugAttribute' => 'alias',
//                'immutable' => true,
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'required'],
            [['status', 'parent_id', 'created_at', 'updated_at'], 'integer'],
            [['alias'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['created_at', 'updated_at'], 'safe'],
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
            'parent_id' => Yii::t('lang', 'Category'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            //**************************************************
            'name' => Yii::t('lang', 'Category Name'),
            'keywords' => Yii::t('lang', 'Keywords'),
            'description' => Yii::t('lang', 'Description'),
        ];
    }
}
