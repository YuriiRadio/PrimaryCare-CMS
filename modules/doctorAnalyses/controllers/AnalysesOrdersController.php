<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\AnalysesOrders;
use app\models\AnalysesOrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AnalysesPackages;
use app\models\Analyses;

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

        # В цьому запиті дістаємо всі $analyses_ids з $analyses_packages
        $arr_analyses_packages_ids = array_map(function ($el){ return intval($el); }, explode(',', $model->analyses_packages_ids));
        $query_analyses_ids = (new \yii\db\Query())
            ->select(["GROUP_CONCAT(`analyses_ids`)"])
            ->from(AnalysesPackages::tableName())
            ->where(['IN', 'id', $arr_analyses_packages_ids])
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
        ->andWhere(['analyses.status' => Analyses::STATUS_ACTIVE])
        ->andWhere(['IN', 'analyses.id', $arr_analyses_ids])
        ->asArray()
        ->all();

        return $this->render('view', [
            'model' => $model,
            'analyses' => $analyses,
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
        $model = new AnalysesOrders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $analyses_packages = AnalysesPackages::find()
//                ->joinWith('category', false, 'LEFT JOIN')
//                ->join('LEFT JOIN', AnalysesCategories::tableName(), '`analyses`.`analyses_categories_id` = `analyses_categories`.`id`')
                ->select(['analyses_packages.id',
                    'analyses_packages.is_free',
                    'analyses_packages.pac_num',
                    'analyses_packages.title',
                    'analyses_packages.analyses_ids',
                    'analyses_packages.cost',
                    'analyses_packages.updated_at',
                ])
                ->andWhere(['analyses_packages.status' => AnalysesPackages::STATUS_ACTIVE])
//                ->orderBy(['analyses_packages.pac_num' => SORT_DESC])
                ->asArray()
                ->all();


        $model->date_biomaterial = date('Y-m-d', time());

        return $this->render('create', [
                    'model' => $model,
                    'analyses_packages' => $analyses_packages
        ]);
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

        # Якщо $model->analyses_packages_ids буде редаговано - очистимо $analyses_values
        $old_analyses_packages_ids = $model->analyses_packages_ids;

        if ($model->load(Yii::$app->request->post())) {

            # Якщо $model->analyses_packages_ids буде редаговано - очистимо $analyses_values
            if ($model->analyses_packages_ids != $old_analyses_packages_ids) {
                $model->analyses_values = '';
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $analyses_packages = AnalysesPackages::find()
        ->select(['analyses_packages.id',
            'analyses_packages.is_free',
            'analyses_packages.pac_num',
            'analyses_packages.title',
            'analyses_packages.analyses_ids',
            'analyses_packages.cost',
            'analyses_packages.updated_at',
        ])
        ->andWhere(['analyses_packages.status' => AnalysesPackages::STATUS_ACTIVE])
//      ->orderBy(['analyses_packages.pac_num' => SORT_DESC])
        ->asArray()
        ->all();

        # В цьому запиті дістаємо всі $analyses_ids з $analyses_packages
        $arr_analyses_packages_ids = array_map(function ($el){ return intval($el); }, explode(',', $model->analyses_packages_ids));
        $query_analyses_ids = (new \yii\db\Query())
            ->select(["GROUP_CONCAT(`analyses_ids`)"])
            ->from(AnalysesPackages::tableName())
            ->where(['IN', 'id', $arr_analyses_packages_ids])
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
        ->andWhere(['analyses.status' => Analyses::STATUS_ACTIVE])
        ->andWhere(['IN', 'analyses.id', $arr_analyses_ids])
        ->asArray()
        ->all();

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
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
