<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

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

/**
 * Description of LanguageWidget
 *
 * @author Yurii Radio
 */
class LanguageWidget extends Widget {

    public $type; #alternate, switch
    public $current_lang;
    public $lang_arr;

    public function init() {
        parent::init();

//        if ($this->type == null) {
//            $this->type = 'switch';
//        }

        $this->lang_arr = Yii::$app->setting->get('LANGUAGES');
    }

    public function run() {

        if ($this->type == 'alternate') {
            return $this->render('language/link', [
                        'lang_arr' => $this->lang_arr,
            ]);
        }

        foreach ($this->lang_arr as $lang_key => $lang_val) {
            if ($lang_val['local'] == Yii::$app->language) {
                $this->current_lang = $lang_val;
                #Delete the current language from $this->lang_arr
                unset($this->lang_arr[$lang_key]);
                break;
            }
        }

        return $this->render('language/view', [
                    'current_lang' => $this->current_lang,
                    'lang_arr' => $this->lang_arr,
        ]);
    }

}
