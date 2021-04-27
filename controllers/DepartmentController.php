<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use app\models\Department;
use app\models\DepartmentSearch;
//use yii\web\NotFoundHttpException;

/**
 * Description of DepartmentController
 *
 * @author Velizar
 */
class DepartmentController extends AppController {

    public function actionIndex()
    {
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id = null, $alias = null) {

//        $id = (int) $id;
//
//        $model = $this->findModel($id);
//        $this->setMeta(Yii::$app->name. ' | ' .$model->name);
//        return $this->render('view', [
//                'model' => $model,
//        ]);

        $model = null;
        if (!is_null($id)) {
            $id = (int) $id;
            $model = Department::find()
                    ->where('id = :id AND status = :status', [':id' => $id, ':status' => Department::STATUS_ACTIVE])
                    ->one();
        }

        if (!is_null($alias)) {
            $alias = clearGetData($alias);
            $model = Department::find()
                    ->where('alias = :alias AND status = :status', [':alias' => $alias, ':status' => Department::STATUS_ACTIVE])
                    ->one();
        }

        if (empty($model)) {
            throw new \yii\web\HttpException(404, Yii::t('lang', 'The requested page does not exist.'));
        }

        $this->setMeta(Yii::$app->name. ' | ' .$model->name);
        return $this->render('view', ['model' => $model]);
    }


//    protected function findModel($id) {
//        if (($model = Department::findOne($id)) !== null) {
//            return $model;
//        }
//
//        throw new NotFoundHttpException(Yii::t('lang', 'The requested page does not exist.'));
//    }
}