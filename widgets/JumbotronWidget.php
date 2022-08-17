<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\Doctor;
use app\models\Department;

/**
 * Description of JumbotronWidget
 *
 * @author Yurii Radio
 */
class JumbotronWidget extends Widget {

    public $widgetHtml = null;

    public function init() {
        parent::init();
    }

    public function run() {

        #get cache
        $this->widgetHtml = Yii::$app->cache->get('jumbotron-' . Yii::$app->language);
        if ($this->widgetHtml) {
            return $this->widgetHtml;
        }

        $doctors = Doctor::find()
                ->where(['status' => Doctor::STATUS_ACTIVE])
                ->count();

        $departments = Department::find()
                ->where('status = :status', [':status' => Department::STATUS_ACTIVE])
                ->count();

        $number_patients = Doctor::find()
                ->where(['status' => Doctor::STATUS_ACTIVE])
                ->sum('number_patients');

        $this->widgetHtml = $this->render('jumbotron/jumbotron', [
            'doctors' => $doctors,
            'departments' => $departments,
            'number_patients' => $number_patients
        ]);

        #set cache
        Yii::$app->cache->set('jumbotron-' . Yii::$app->language, $this->widgetHtml, Yii::$app->setting->get('CACHE.TIME_MENU'));
        return $this->widgetHtml;
    }

}
