<?php

namespace app\components;

use Yii;
use yii\base\Component;

/**
 * Description of AutoRunComponent
 *
 * https://klisl.com/yii2_events.html - інформація
 *
 * @author Velizar
 */

class AutoRunComponent extends Component {

        public function init() {
            parent::init();

//            $this->on(yii\base\Application::EVENT_BEFORE_REQUEST,
//                    Yii::$app->urlManager->languages = ['uk' => 'uk-UA', 'en' => 'en-GB', 'ru' => 'ru-RU']
//            );
//
//            $this->on(yii\base\Application::EVENT_BEFORE_REQUEST,
//                Yii::$app->name = Yii::$app->setting->get('APP_NAME')
//            );
//
//            Yii::$app->name = Yii::$app->setting->get('APP_NAME'); #Перенесено в class BootstrapComponent implements BootstrapInterface

    }

}
