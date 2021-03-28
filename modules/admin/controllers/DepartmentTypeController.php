<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\base\Model;
use app\models\DepartmentType;
use app\models\DepartmentTypeI18n;
use app\models\DepartmentTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentTypeController implements the CRUD actions for DepartmentType model.
 */
class DepartmentTypeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all DepartmentType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DepartmentType model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DepartmentType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new DepartmentType();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    public function actionCreate()
    {
        $model = new DepartmentType();
        $i18nMessages = [new DepartmentTypeI18n()];
        //$languages = Yii::$app->components['urlManager']['languages']; #old
        $languages = array_values(Yii::$app->components['urlManager']['languages']);

        for ($i = 0; $i < count($languages); $i++) {
            $i18nMessages[$i] = new DepartmentTypeI18n();
            //$i18nMessages[$i]->language = each($languages)[1]; #old
            $i18nMessages[$i]->language = $languages[$i];
        }

        //if (($model->load(Yii::$app->request->post()) && $model->validate()) && (Model::loadMultiple($i18nMessages, Yii::$app->request->post()) && Model::validateMultiple($i18nMessages))) {
        if (Model::loadMultiple($i18nMessages, Yii::$app->request->post()) && Model::validateMultiple($i18nMessages)) {
            // Зберігаємо основну модель
            $model->save(false);
            // Зберігаємо інтернаціоналізаційні повідомлення моделі
            foreach ($i18nMessages as $i18nMessage) {
                $i18nMessage->parent_table_id = $model->id;
                $i18nMessage->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'i18nMessages' => $i18nMessages,
            ]);
        }
    }

    /**
     * Updates an existing DepartmentType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $i18nMessages = DepartmentTypeI18n::find()
                ->where(['parent_table_id' => $model->id])
                //->indexBy('id')
                ->all();

        //if (($model->load(Yii::$app->request->post()) && $model->validate()) && (Model::loadMultiple($i18nMessages, Yii::$app->request->post()) && Model::validateMultiple($i18nMessages))) {
        if (Model::loadMultiple($i18nMessages, Yii::$app->request->post()) && Model::validateMultiple($i18nMessages)) {
            // Зберігаємо основну модель
            $model->save(false);
            // Зберігаємо інтернаціоналізаційні повідомлення моделі
            foreach ($i18nMessages as $i18nMessage) {
                $i18nMessage->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'i18nMessages' => $i18nMessages,
            ]);
        }
    }

    /**
     * Deletes an existing DepartmentType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            DepartmentTypeI18n::deleteAll(['parent_table_id' => $id]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the DepartmentType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DepartmentType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DepartmentType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lang', 'The requested page does not exist.'));
    }
}
