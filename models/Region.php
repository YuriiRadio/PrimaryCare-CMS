<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
//use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "regions".
 *
 * @property string $id
 * @property string $alias
 * @property string $parent_id
 * @property string $created_at
 * @property string $updated_at
 */
class Region extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regions';
    }

    public function getI18n() {
        return $this->hasOne(RegionI18n::className(), ['parent_table_id' => 'id'])
            ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getName() {
        return $this->i18n->name;
    }

    public function getParentCategory() {
        return $this->hasOne(Region::className(), ['id' => 'parent_id']);
    }

    public static function getParentsList() {
        // Вибираємо ті категорії в яких є дочірні
        $parents = Region::find()
            ->select(['regions.id', 'regions_i18n.name'])
            ->join('JOIN', 'regions_i18n', 'regions_i18n.parent_table_id = regions.id')
            ->join('JOIN', 'regions a', 'a.parent_id = regions.id')
            ->where('regions_i18n.language = :language', [':language' => Yii::$app->language])
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
            [['parent_id', 'created_at', 'updated_at'], 'integer'],
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
            'alias' => Yii::t('lang', 'Alias'),
            'parent_id' => Yii::t('lang', 'Category'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            //**************************************************
            'name' => Yii::t('lang', 'Category Name'),
        ];
    }
}
