<?php

/**
 * Description of AutoRunEventComponent
 *
 *
 * @author Velizar
 */

namespace app\components;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;

class BootstrapComponent implements BootstrapInterface {

    public function bootstrap($app) {

//        Event::on(\yii\base\Application::className(), yii\base\Application::EVENT_BEFORE_REQUEST,
//            function ($event) {
//                Yii::$app->urlManager->languages = ['uk' => 'uk-UA', 'en' => 'en-GB', 'ru' => 'ru-RU'];
//            }
//        );

        /*
        * Формат масиву LANGUAGES, масив unserialize в SettingComponent
        * Yii::$app->setting->get('LANGUAGES')
        * $languages = [
            [
                'status' => 1,
                'default' => 1,
                'name' => 'Українська',
                'url' => 'uk',
                'local' => 'uk-UA'
            ],
            [
                'status' => 1,
                'default' => 0,
                'name' => 'English',
                'url' => 'en',
                'local' => 'en-GB'
            ]
        ];
        */

        #Встановлюємо мову по замовчуванню та передаємо масив мов в urlManager, взяті з налаштувань
        $arrLanguages = $app->setting->get('LANGUAGES');
        $urlManagerLanguages = [];
        foreach ($arrLanguages as $item) {
            if ($item['default']) $app->language = $item['local'];
            $urlManagerLanguages[$item['url']] = $item['local'];
        }
        $app->urlManager->languages = $urlManagerLanguages;

        #Встановлюємо глобальну назву додатка
        $app->name = $app->setting->get('APP.NAME');
//        Yii::$app->name = Yii::$app->setting->get('APP_NAME');

    }

}
