<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\StaticPage;
use app\models\StaticPageI18n;

/**
 * Description of MainMenuWidget
 *
 * @author Velizar
 */
class StaticPageMenuWidget extends Widget {

    //header, footer (default)
    public $position;

    public function init() {
        parent::init();

        if ($this->position == null) {
            $this->position = 'footer';
        }
    }

    public function run() {

        // Get cache
        $model = Yii::$app->cache->get($this->position.Yii::$app->language);
        if ($model) {
            return $this->render('static_menu/'.$this->position, ['model' => $model]);
        }

        // Get records from Database
        $model = StaticPage::find()
            ->innerJoin(StaticPageI18n::tableName(), '`'.StaticPageI18n::tableName().'`.`static_page_id` = `'.StaticPage::tableName().'`.`id`')
            ->select([
                StaticPage::tableName().'.id',
                StaticPage::tableName().'.alias',
                StaticPageI18n::tableName().'.title',
                //StaticPageI18n::tableName().'.body',
                //StaticPage::tableName().'.created_at',
                //StaticPage::tableName().'.updated_at'
             ])
            ->where('((`position` = :position) AND (`status` = :status) AND (`language` = :language)) AND (`alias` != :contact)')
            ->addParams([':position' => $this->position])
            ->addParams([':status' => StaticPage::STATUS_ACTIVE])
            ->addParams([':language' => Yii::$app->language])
            ->addParams([':contact' => 'contact'])
            ->asArray()
            ->all();

        // Set cache
        Yii::$app->cache->set($this->position.Yii::$app->language, $model, Yii::$app->setting->get('CACHE.TIME_MENU'));

        return $this->render('static_menu/'.$this->position, ['model' => $model]);
    }
}