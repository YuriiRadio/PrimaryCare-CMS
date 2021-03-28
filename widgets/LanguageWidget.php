<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\widgets;

use Yii;
use yii\base\Widget;

/**
 * Description of LanguageWidget
 *
 * @author Velizar
 */
class LanguageWidget extends Widget {

    public $type; #alternate, switch

    public function init() {
        parent::init();

//        if ($this->type == null) {
//            $this->type = 'switch';
//        }
    }

    public function run() {
        $lang = Yii::$app->language;
        $lang_arr = Yii::$app->components['urlManager']['languages'];
//        $lang_arr = Yii::$app->urlManager->languages;
        $lang_url = array_search($lang, Yii::$app->components['urlManager']['languages']);
        unset($lang_arr[$lang_url]);
        //asort($lang_arr);
        //debug($lang_arr, true);

        if ($this->type == 'alternate') {
            return $this->render('language/link', [
                        'current' => $lang,
                        'languages' => $lang_arr,
            ]);
        }

        return $this->render('language/view', [
                    'current' => $lang,
                    'languages' => $lang_arr,
        ]);
    }

}
