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
    public $verifyCode;
    public $ip;

    const SCENARIO_GET = 'GET';
    const SCENARIO_AJAX = 'AJAX';


    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_GET] = ['declaration_number', 'verifyCode', 'ip'];
        $scenarios[self::SCENARIO_AJAX] = ['declaration_number', 'ip'];
        return $scenarios;
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            ['declaration_number', 'required'],
            ['declaration_number', 'string', 'max' => 14],
            [['declaration_number'], 'filter', 'filter' => 'trim'],
            ['declaration_number', 'validateDeclarationNumber'],
            ['verifyCode', 'captcha', 'on' => self::SCENARIO_GET],
            ['verifyCode', 'captcha', 'skipOnEmpty' => true, 'on' => self::SCENARIO_AJAX],
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
            'verifyCode' => Yii::t('lang', 'Verification Code'),
            'ip' => Yii::t('lang', 'IP address')
        ];
    }

    public function searchOrders() {
        $orders = AnalysesOrders::find()
                ->joinWith('patient', false, 'JOIN')
                ->select(['analyses_orders.id', 'patients.name as patient', 'analyses_orders.analyses_packages_nums as pac_nums', 'analyses_orders.created_at', 'analyses_orders.updated_at', 'analyses_orders.views'])
                ->where(['`analyses_orders`.`status`' => AnalysesOrders::STATUS_DONE])
                ->andWhere('`declaration_number` = :declaration_number')
                ->addParams([':declaration_number' => $this->declaration_number])
                ->orderBy(['`analyses_orders`.`created_at`' => SORT_DESC])
                ->asArray()
                ->all();

        return $orders;
    }

    public function loadOrder($order_id) {
        $order_id = intval($order_id);
        $order = AnalysesOrders::find()
                ->joinWith('patient', false, 'JOIN')
//                ->select(['analyses_orders.id', 'patients.name as patient', 'analyses_orders.analyses_packages_nums as pac_nums', 'analyses_orders.created_at', 'analyses_orders.updated_at', 'analyses_orders.views'])
                ->where(['`analyses_orders`.`status`' => AnalysesOrders::STATUS_DONE])
                ->andWhere('`analyses_orders`.`id` = :order_id ')
                ->addParams([':order_id' => $order_id])
//                ->asArray()
                ->one();

        return $order;
    }

}
