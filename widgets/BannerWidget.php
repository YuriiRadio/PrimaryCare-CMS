<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\Banner;


/**
 * Description of BannerWidget
 *
 * @author Velizar
 */
class BannerWidget extends Widget {

    public $position = 'bottom'; #'top','bottom','left','right','center'
    public $bannerHtml = null;
    public $model = null;

    public function init() {
        parent::init();

    }

    public function run() {
        #get cache
        $this->bannerHtml = Yii::$app->cache->get($this->position.'-banner-'.Yii::$app->language);
        if ($this->bannerHtml) {
            return $this->bannerHtml;
        }

        $this->model = Banner::find()
            //->joinWith('i18n')
            ->innerJoin(\app\models\BannerI18n::tableName(), '`'.\app\models\BannerI18n::tableName().'`.`parent_table_id` = `'.Banner::tableName().'`.`id`')
            ->select([Banner::tableName().'.id', 'name', 'url_link', 'img_src'])
            ->where('((`position` = :position) AND (`status` = :status) AND (`to_date` >= :date) AND (`language` = :language))')
            ->addParams([':position' => $this->position])
            ->addParams([':status' => Banner::STATUS_ACTIVE])
            ->addParams([':date' => time()])
            ->addParams([':language' => Yii::$app->language])
            ->asArray()
            ->all();

        if (!empty($this->model)) {

            for($i = 0; $i < count($this->model); $i++) {
                if (empty($this->model[$i]['img_src'])) {
                    $this->model[$i]['img_src'] = "no-image.png";
                }
            }
    //debug($this->model, true);
            $this->bannerHtml = $this->render('banner/'.$this->position, ['model' => $this->model]);
            #set cache
            Yii::$app->cache->set($this->position.'-banner-'.Yii::$app->language, $this->bannerHtml, Yii::$app->setting->get('CACHE.TIME_MENU'));
            return $this->bannerHtml;
        } else {
            return "";
        }

    }

}