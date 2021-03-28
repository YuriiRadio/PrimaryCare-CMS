<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "static_pages".
 *
 * @property string $id
 * @property int $status
 * @property string $alias
 * @property string $position
 * @property string $created_at
 * @property string $updated_at
 */
class StaticPage extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_pages';
    }

    // Інтернаціоналізація
    public function getI18n()
    {
        return $this->hasOne(StaticPageI18n::className(), ['static_page_id' => 'id'])
            ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getTitle()
    {
        return $this->i18n->title;
    }

    public function getBody()
    {
        return $this->i18n->body;
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at', 'views'], 'integer'],
            [['alias'], 'required'],
            [['alias'], 'unique'],
            [['alias'], 'string', 'max' => 255],
            [['og_image'], 'string', 'max' => 255],
            [['alias', 'og_image'], 'trim'],
            [['position'], 'string'],
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
            //****************************************
            'title' => Yii::t('lang', 'Title'),
            'body' => Yii::t('lang', 'Body'),
            //****************************************
            'position' => Yii::t('lang', 'Position'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            'views' => Yii::t('lang', 'Views'),
            'og_image' => Yii::t('lang', 'og:image'),
        ];
    }
}
