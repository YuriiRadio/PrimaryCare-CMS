<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use app\models\Doctor;
use yii\web\NotFoundHttpException;

/**
 * Description of DoctorController
 *
 * @author Velizar
 */
class DoctorController extends AppController {

    public function actionIndex($department = null, $specialization = null, $category = null, $declarations = null) {

        $department = (int) $department;
        $specialization = (int) $specialization;
        $category = (int) $category;
        $declarations = (int) $declarations;

        // Показуємо тільки з активним статусом
        $where = 'status = :status';
        $where_param[':status'] = Doctor::STATUS_ACTIVE;

        $filters = [];

        if (!empty($department)) {
            $where .= ' AND department_id = :department';
            $where_param[':department'] = $department;
            $filters['department'] = $department;
        }

        if (!empty($specialization)) {
            $where .= ' AND doctor_specialization_id = :specialization';
            $where_param[':specialization'] = $specialization;
            $filters['specialization'] = $specialization;
        }

        if (!empty($category)) {
            $where .= ' AND doctor_category_id = :category';
            $where_param[':category'] = $category;
            $filters['category'] = $category;
        }

        if (!empty($declarations)) {
            $where .= ' AND number_patients < allowed_number_patients';
            $filters['declarations'] = $declarations;
        }

        $query = Doctor::find()
                ->with('i18n')
                ->with('specialization')
                ->with('category')
                ->with('department')
                ->where($where, $where_param);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => Yii::$app->setting->get('DOCTOR.CART_COUNT'),
            'forcePageParam' => FALSE,
            'pageSizeParam' => FALSE
        ]);

        $doctors = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta(Yii::$app->name . ' | ' . Yii::t('lang', 'doctors'), Yii::$app->setting->get('SITE.KEYWORDS'), Yii::$app->setting->get('SITE.DESCRIPTION'));

        if (Yii::$app->request->isAjax) {
            $this->layout = false;
            return $this->render('index-filter', ['doctors' => $doctors, 'pages' => $pages, 'filters' => $filters]);
        }

        return $this->render('index', ['doctors' => $doctors, 'pages' => $pages, 'filters' => $filters]);
    }

    public function actionView($id = null) {

        if (Yii::$app->request->isAjax) {
            $id = (int) Yii::$app->request->post('id');
            $this->layout = false;
            $model = $this->findModel($id);
            $result = [];
            $result['name'] = $model->name;
            $result['body'] = $this->render('doctor-modal', ['model' => $model]);
            return json_encode($result);
        }

        $id = (int) $id;
        $model = $this->findModel($id);

        // Збільшуємо лічильник переглядів на 1
        $model->views = $model->views + 1;
        $model->detachBehavior('TimestampBehavior');
        $model->save(false);

        $this->view->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->request->hostInfo.'/web/uploads/doctor-fotos/small/'.$model->imageSmall]);
        $this->setMeta(Yii::$app->name . ' | ' . @$model->name, @$model->name, Yii::$app->setting->get('SITE.DESCRIPTION'));

        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    protected function findModel($id) {
        $model = Doctor::find()
                ->where('id = :id AND status = :status', [':id' => $id, ':status' => Doctor::STATUS_ACTIVE])
                ->one();
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lang', 'The requested page does not exist.'));
    }

}
