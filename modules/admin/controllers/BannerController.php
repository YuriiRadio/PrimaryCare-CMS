<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\base\Model;
use app\models\Banner;
use app\models\BannerI18n;
use app\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BannerController implements the CRUD actions for Doctor model.
 */
class BannerController extends Controller
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
     * Lists all banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
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
     * Creates a new Doctor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Doctor();
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
        $model = new Banner();
        $i18nMessages = [new BannerI18n()];
        //$languages = Yii::$app->components['urlManager']['languages']; #old
        $languages = array_values(Yii::$app->components['urlManager']['languages']);

        for ($i = 0; $i < count($languages); $i++) {
            $i18nMessages[$i] = new BannerI18n();
            //$i18nMessages[$i]->language = each($languages)[1]; #old
            $i18nMessages[$i]->language = $languages[$i];
        }

        if (($model->load(Yii::$app->request->post()) && $model->validate()) && (Model::loadMultiple($i18nMessages, Yii::$app->request->post()) && Model::validateMultiple($i18nMessages))) {
            // Зберігаємо основну модель
            $model->save(false);
            // Зберігаємо інтернаціоналізаційні повідомлення моделі
            foreach ($i18nMessages as $i18nMessage) {
                $i18nMessage->parent_table_id = $model->id;
                $i18nMessage->save(false);
            }
            #Очищаємо весь кеш
            //\yii\caching\Cache::flush();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'i18nMessages' => $i18nMessages,
            ]);
        }
    }

    /**
     * Updates an existing Doctor model.
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
        $model->to_date_normal = date('d.m.Y', $model->to_date);
        $i18nMessages = BannerI18n::find()
                ->where(['parent_table_id' => $model->id])
                //->indexBy('id')
                ->all();

        if (($model->load(Yii::$app->request->post()) && $model->validate()) && (Model::loadMultiple($i18nMessages, Yii::$app->request->post()) && Model::validateMultiple($i18nMessages))) {
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
     * Deletes an existing Doctor model.
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
            BannerI18n::deleteAll(['parent_table_id' => $id]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Doctor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Doctor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lang', 'The requested page does not exist.'));
    }

    /**
     *
     * @param type $img_id
     * @return type
     * @throws ForbiddenHttpException
     */
    public function actionDelImage($id) {
        $id = intval($id);
        $model = $this->findModel($id);
        $dir = Yii::getAlias('uploads/banners/');
        if(@unlink($dir.$model->img_src)) {
            $model->img_src = "";
            $model->save(false);
        }
        return $this->redirect(['update', 'id' => $model->id]);
    }

}
