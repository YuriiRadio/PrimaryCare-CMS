<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\AnalysesPackages;
use app\models\AnalysesPackagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Analyses;

/**
 * AnalysesPackagesController implements the CRUD actions for AnalysesPackages model.
 */
class AnalysesPackagesController extends Controller {

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

    /**
     * Lists all AnalysesPackages models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AnalysesPackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnalysesPackages model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AnalysesPackages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new AnalysesPackages();
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
        $model = new AnalysesPackages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $analyses = Analyses::find()
                ->joinWith('category', false, 'LEFT JOIN')
//                ->join('LEFT JOIN', AnalysesCategories::tableName(), '`analyses`.`analyses_categories_id` = `analyses_categories`.`id`')
                ->select(['analyses.id',
//                    'analyses_categories.id AS cat_id',
                    'analyses_categories.title AS cat_title',
                    'analyses.title',
                    'analyses.units',
                ])
//                ->orderBy('analyses.analyses_categories_id')
                ->andWhere(['analyses.status' => Analyses::STATUS_ACTIVE])
                ->asArray()
                ->all();

        return $this->render('create', [
                    'model' => $model,
                    'analyses' => $analyses,
        ]);
    }

    /**
     * Updates an existing AnalysesPackages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AnalysesPackages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnalysesPackages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnalysesPackages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AnalysesPackages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lang', 'The requested page does not exist.'));
    }

}
