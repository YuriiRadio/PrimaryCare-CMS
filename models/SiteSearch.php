<?php

namespace app\models;

use Yii;
use yii\base\Model;

//use yii\db\ActiveRecord;

class SiteSearch extends Model {

    public $search;
    public $doctors = [];

    public function __construct($str) {
        //parent::__construct($config);
        $str = $this->clearText($str);
        $this->search = $str;
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            //['text', 'string', 'min' => 4, 'message' => Yii::t('lang', 'Error mimimun >= 4 chars')],
            ['search', 'string', 'min' => 4],
        ];
    }

    /**
     * Clear text.
     *
     * @param string $str
     * @return string
     */
    public function clearText($str) {
        $str = trim(strip_tags($str));
        //$inputString = htmlspecialchars($inputString, ENT_QUOTES);
        //$inputString = mysql_escape_string($inputString);
        // "!", """, "$", "'", "*", "/", ":", "<", ">", "?", "\", "^", "`", "|", "~"
        $quotes = array("\x21", "\x22", "\x24", "\x27", "\x2A", "\x2F", "\x3A", "\x3C", "\x3E", "\x3F", "\x5C", "\x5E", "\x60", "\x7C", "\x7E", "\t", "\n", "\r");

        $str = str_replace($quotes, '', $str);
        return $str;
    }

    public function search() {

        $doctors = Doctor::find()
                ->joinWith('i18n')
                ->where('`status` = :status AND `name` LIKE :name')
                ->addParams([':status' => Doctor::STATUS_ACTIVE])
                ->addParams([':name' => '%'.$this->search.'%'])
                ->asArray()
                ->all();
        $this->doctors = $doctors;
    }


}
