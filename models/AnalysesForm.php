<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Description of AnalysesForm
 *
 * @author Velizar
 */
class AnalysesForm extends Model {

    public $declaration_number;
//    public $verifyCode;
    public $ip;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            ['declaration_number', 'required'],
            ['declaration_number', 'string', 'max' => 14],
            [['declaration_number'], 'filter', 'filter' => 'trim'],
            ['declaration_number', 'validateDeclarationNumber'],
//            ['verifyCode', 'captcha'],
            ['ip', 'ip'],
        ];
    }

    public function validateDeclarationNumber($attribute, $params, $validator) {
        $pattern = "#[a-z0-9]{4,4}-[a-z0-9]{4,4}-[a-z0-9]{4,4}#is";
        if (!preg_match($pattern, $this->$attribute)) {
            $this->addError($attribute, Yii::t('lang', 'Enter the declaration number in the format: ХХХХ-ХХХХ-ХХХХ Use only English characters!!!'));
        }
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'declaration_number' => Yii::t('lang', 'Declaration number'),
//            'verifyCode' => Yii::t('lang', 'Verification Code'),
            'ip' => Yii::t('lang', 'IP address')
        ];
    }

}
