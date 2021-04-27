<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
//use app\models\Banner;
use app\models\Doctor;
use app\models\Department;

/**
 * Description of JumbotronWidget
 *
 * @author Yurii Radio
 */
class JumbotronWidget extends Widget {

    public $widgetHtml = null;

//    public $model = null;

    public function init() {
        parent::init();
    }

    public function run() {
        #get cache
//        $this->widgetHtml = Yii::$app->cache->get('jumbotron-'.Yii::$app->language);
//        if ($this->widgetHtml) {
//            return $this->widgetHtml;
//        }
//        $this->model = Banner::find()
//            //->joinWith('i18n')
//            ->innerJoin(\app\models\BannerI18n::tableName(), '`'.\app\models\BannerI18n::tableName().'`.`parent_table_id` = `'.Banner::tableName().'`.`id`')
//            ->select([Banner::tableName().'.id', 'name', 'url_link', 'img_src'])
//            ->where('((`position` = :position) AND (`status` = :status) AND (`to_date` >= :date) AND (`language` = :language))')
//            ->addParams([':position' => $this->position])
//            ->addParams([':status' => Banner::STATUS_ACTIVE])
//            ->addParams([':date' => time()])
//            ->addParams([':language' => Yii::$app->language])
//            ->asArray()
//            ->all();

        $doctors = Doctor::find()
                ->where(['status' => Doctor::STATUS_ACTIVE])
                ->count();

        $departments = Department::find()
                ->where('status = :status', [':status' => Department::STATUS_ACTIVE])
                ->count();

        $number_patients = Doctor::find()
                ->where(['status' => Doctor::STATUS_ACTIVE])
                ->sum('number_patients');

//    debug($number_patients, true);
//        if (!empty($this->model)) {
//
//            for($i = 0; $i < count($this->model); $i++) {
//                if (empty($this->model[$i]['img_src'])) {
//                    $this->model[$i]['img_src'] = "no-image.png";
//                }
//            }
//            $this->widgetHtml = $this->render('jumbotron/'.$this->position, ['model' => $this->model]);
        $this->widgetHtml = $this->render('jumbotron/jumbotron', [
            'doctors' => $doctors,
            'departments' => $departments,
            'number_patients' => $number_patients
        ]);
        #set cache
//            Yii::$app->cache->set('jumbotron-'.Yii::$app->language, $this->widgetHtml, Yii::$app->setting->get('CACHE.TIME_MENU'));
        return $this->widgetHtml;
//        } else {
//            return "";
//        }
    }

}
