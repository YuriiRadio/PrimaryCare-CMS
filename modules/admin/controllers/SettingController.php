<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\base\Model;
use app\models\Setting;
use app\modules\admin\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SettingController extends AppAdminController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex() {
        $settings = Setting::find()
                ->orderBy('param ASC')
                ->all();

        return $this->render('index', ['settings' => $settings]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save(false);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lang', 'The requested page does not exist.'));
    }

}
