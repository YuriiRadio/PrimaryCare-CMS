<?php

namespace app\modules\doctorAnalyses;

use Yii;
use yii\filters\AccessControl;
use app\models\Doctor;

/**
 * analyses module definition class
 */
class Module extends \yii\base\Module
{
    static public $doctor;

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\doctorAnalyses\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here

        self::$doctor = Doctor::find()
                ->joinWith('i18n', false)
                ->select([\app\models\DoctorI18n::tableName() . '.name', Doctor::tableName() . '.id', Doctor::tableName() . '.email'])
                ->where([Doctor::tableName() . '.status' => Doctor::STATUS_ACTIVE])
                ->andWhere([Doctor::tableName() . '.email' => Yii::$app->user->identity->email])
                ->one();
//        debug($this->doctor->name);

        if (!is_null(self::$doctor)) {
            Yii::$app->user->identity->username = self::$doctor->name;
        }
    }

        public function behaviors() {
        parent::behaviors();

        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        //'actions' => ['logout', 'index'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isDoctor();
                        }
                    ],
                ],
            ],
        ];
    }

}
