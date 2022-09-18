<?php

namespace app\modules\laborantAnalyses\controllers;

use Yii;
use app\models\AnalysesOrders;
use app\models\AnalysesOrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AnalysesPackages;
use app\models\Analyses;
use app\modules\laborantAnalyses\Module;
use app\models\Patients;

/**
 * AnalysesOrdersController implements the CRUD actions for AnalysesOrders model.
 */
class AnalysesOrdersController extends Controller {

    /**
     * {@inheritdoc}
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

    public function actionPatientsList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '', 'birth' => '', 'our_patient' => '']];
        if (!is_null($q)) {
            $query = new \yii\db\Query;
            $query->select('id, name AS text, birth, our_patient')
                    ->from('patients')
                    ->where(['like', 'name', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif (intval($id) > 0) {
            $out['results'] = ['id' => $id, 'text' => Patients::find($id)->name];
        }
        return $out;
    }

    /**
     * Lists all AnalysesOrders models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AnalysesOrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnalysesOrders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionView($id) {
//        return $this->render('view', [
//                    'model' => $this->findModel($id),
//        ]);
//    }

    public function actionView($id) {

        $model = $this->findModel($id);

        $arr_analyses_packages_nums = array_map(function ($el){ return trim($el); }, explode(',', $model->analyses_packages_nums));
        $analyses_packages = AnalysesPackages::find()
        ->select(['id', 'is_free', 'pac_num', 'title', 'analyses_ids', 'cost'])
        ->where(['IN', 'pac_num', $arr_analyses_packages_nums])
        //->orderBy(['analyses_packages.pac_num' => SORT_DESC])
        ->asArray()
        ->all();

        $sum = 0.0;
        $arr_analyses_ids = [];
        foreach ($analyses_packages as $analys_package) {
            if (!intval($model->patient->our_patient) || !intval($analys_package['is_free'])) {
                $sum += floatval($analys_package['cost']);
            }
            $arr_analyses_ids = array_merge($arr_analyses_ids, array_map(function ($el){ return intval($el); }, explode(',', $analys_package['analyses_ids'])));
        }

        if (Yii::$app->request->isAjax) {
           return $model->orderInvoiceEmail($analyses_packages, $sum) ? 1 : 0;
        }

        $analyses = Analyses::find()
        ->joinWith('category', false, 'LEFT JOIN')
//      ->join('LEFT JOIN', AnalysesCategories::tableName(), '`analyses`.`analyses_categories_id` = `analyses_categories`.`id`')
        ->select(['analyses.id',
            'analyses_categories.title AS cat_title',
            'analyses.title',
            'analyses.units',
            'analyses.norm',
        ])
//      ->orderBy('analyses.analyses_categories_id')
        ->where(['analyses.status' => Analyses::STATUS_ACTIVE])
        ->andWhere(['IN', 'analyses.id', $arr_analyses_ids])
        ->asArray()
        ->all();

        if ($model->status == $model::STATUS_DONE) {
            // Збільшуємо лічильник переглядів на 1
            $model->views = $model->views + 1;
            $model->detachBehavior('TimestampBehavior');
            $model->save(false);
        }

        return $this->render('print_view', [
            'model' => $model,
            'analyses_packages' => $analyses_packages,
            'sum' => $sum,
            'analyses' => $analyses
        ]);
    }


    /**
     * Creates a new AnalysesOrders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new AnalysesOrders();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    public function actionCreate() {

        Yii::$app->session->setFlash('error', Yii::t('lang', 'You are not allowed to create orders.'));
        return $this->redirect(['index']);

//        $model = new AnalysesOrders();
//
//        $model->doctor_id = Module::$doctor->id;
//        $model->status = $model::STATUS_NEW;
//
//        if ($model->load(Yii::$app->request->post())) {
//
//            # Захист від підробки лікаря, статусу
//            $model->doctor_id = Module::$doctor->id;
//            $model->status = $model::STATUS_NEW;
//
//            if ($model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//
//        }
//
//        $analyses_packages = AnalysesPackages::find()
//            ->select(['id', 'is_free', 'pac_num', 'title', 'analyses_ids', 'cost', 'updated_at'])
//            ->andWhere(['analyses_packages.status' => AnalysesPackages::STATUS_ACTIVE])
//    //                ->orderBy(['pac_num' => SORT_DESC])
//            ->asArray()
//            ->all();
//
//        $model->date_biomaterial = date('Y-m-d', time());
//
//        return $this->render('create', [
//                    'model' => $model,
//                    'analyses_packages' => $analyses_packages
//        ]);
    }

    /**
     * Updates an existing AnalysesOrders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
//    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

//        if ($model->doctor_id != Module::$doctor->id) {
//            Yii::$app->session->setFlash('warning', Yii::t('lang', 'You can update only your orders.'));
//            return $this->redirect(['index']);
//        }

        if ($model->status == $model::STATUS_DONE) {
            Yii::$app->session->setFlash('warning', Yii::t('lang', 'With the status - done, editing is not possible.'));
            return $this->redirect(['index']);
        }

        $analyses_packages = AnalysesPackages::find()
        ->select(['id', 'is_free', 'pac_num', 'title', 'analyses_ids', 'cost', 'updated_at'])
        ->where(['status' => AnalysesPackages::STATUS_ACTIVE])
//      ->orderBy(['analyses_packages.pac_num' => SORT_DESC])
        ->asArray()
        ->all();

        # В цьому запиті дістаємо всі $analyses_ids з $analyses_packages
        //$arr_analyses_packages_ids = array_map(function ($el){ return intval($el); }, explode(',', $model->analyses_packages_ids));
        $arr_analyses_packages_nums = array_map(function ($el){ return trim($el); }, explode(',', $model->analyses_packages_nums));
        $query_analyses_ids = (new \yii\db\Query())
            ->select(["GROUP_CONCAT(`analyses_ids`)"])
            ->from(AnalysesPackages::tableName())
            ->where(['IN', 'pac_num', $arr_analyses_packages_nums])
            ->scalar();

        $arr_analyses_ids = array_map(function ($el){ return intval($el); }, explode(',', $query_analyses_ids));
        $analyses = Analyses::find()
        ->joinWith('category', false, 'LEFT JOIN')
//      ->join('LEFT JOIN', AnalysesCategories::tableName(), '`analyses`.`analyses_categories_id` = `analyses_categories`.`id`')
        ->select(['analyses.id',
            'analyses_categories.title AS cat_title',
            'analyses.title',
            'analyses.units',
            'analyses.norm',
        ])
//      ->orderBy('analyses.analyses_categories_id')
        ->where(['analyses.status' => Analyses::STATUS_ACTIVE])
        ->andWhere(['IN', 'analyses.id', $arr_analyses_ids])
        ->asArray()
        ->all();

        # Якщо $model->analyses_packages_nums буде редаговано - очистимо $analyses_values
        $old_analyses_packages_nums = $model->analyses_packages_nums;
        $old_status = $model->status;
        $old_patient_id = $model->patient_id;

        if ($model->load(Yii::$app->request->post())) {

            # Захист від підробки пацієнта
            $model->patient_id = $old_patient_id;

            # Якщо $model->analyses_values не пустий - оновити status на STATUS_EDITED
            if (!empty($model->analyses_values)) {
                $model->status = $model::STATUS_EDITED;

                # Якщо введені всі значення аналізу встановлюємо STATUS_DONE
                if (count($arr_analyses_ids) === count(json_decode($model->analyses_values, 1))) {
                    $model->status = $model::STATUS_DONE;
                }
            }

//            # Якщо $model->analyses_packages_nums буде редаговано зі статусом EDITED - не зберігаємо модель і виводимо повідомлення
//            if ($old_status == $model::STATUS_EDITED && $model->analyses_packages_nums != $old_analyses_packages_nums) {
//                Yii::$app->session->setFlash('warning', Yii::t('lang', 'With the status - edited, it is impossible to change packages.'));
//                return $this->refresh();
//            }

//            # Якщо $model->analyses_packages_nums буде редаговано (тільки зі статусом NEW) - очистимо $analyses_values
//            if ($old_status == $model::STATUS_NEW && $model->analyses_packages_nums != $old_analyses_packages_nums) {
//                $model->analyses_values = '';
//            }

            # Захист від зміни analyses_packages_nums, тільки для лаборантів
            $model->analyses_packages_nums = $old_analyses_packages_nums;

            # Додаємо id лаборанта
            if (empty($model->laborants_ids)) {
                $model->laborants_ids = (string)Module::$laborant->id;
            } else {
                $arr_laborants_ids = array_map(function ($el){ return intval($el); }, explode(',', $model->laborants_ids));
                if (array_search((int)Module::$laborant->id, $arr_laborants_ids, true) === false) {
                    $model->laborants_ids = implode(',', $arr_laborants_ids) . ',' . Module::$laborant->id;
                }
            }

            if ($model->save()) {
                if ($model->status === $model::STATUS_DONE) {
                    if ($model->analysOrderEmail($analyses)) {
                        Yii::$app->session->setFlash('success', Yii::t('lang', 'Email with the result has been sent to the patient.'));
                    } else {
                        Yii::$app->session->setFlash('warning', Yii::t('lang', 'The result email was not sent to the patient.'));
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $model->date_biomaterial = date('Y-m-d', $model->date_biomaterial);

        return $this->render('update', [
                    'model' => $model,
                    'analyses_packages' => $analyses_packages,
                    'analyses' => $analyses,
        ]);
    }

    /**
     * Deletes an existing AnalysesOrders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id) {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    public function actionDelete($id) {

        Yii::$app->session->setFlash('error', Yii::t('lang', 'You are not allowed to delete orders.'));
        return $this->redirect(['index']);

//        $model = $this->findModel($id);
//
//        if ($model->doctor_id != Module::$doctor->id) {
//            Yii::$app->session->setFlash('error', Yii::t('lang', 'You can delete only your orders.'));
//            return $this->redirect(['index']);
//        }
//
//        if ($model->status == $model::STATUS_EDITED || $model->status == $model::STATUS_DONE) {
//            Yii::$app->session->setFlash('error', Yii::t('lang', 'With the status - edited or done, deletion is impossible.'));
//            return $this->redirect(['index']);
//        }
//
//        $model->delete();
//        return $this->redirect(['index']);
    }

    /**
     * Finds the AnalysesOrders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnalysesOrders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AnalysesOrders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lang', 'The requested page does not exist.'));
    }

}
