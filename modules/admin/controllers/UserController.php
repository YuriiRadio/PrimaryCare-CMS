<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //$admin = User::find(['role' => User::ROLE_ADMIN])->one();
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->role == User::ROLE_ADMIN) {
                Yii::$app->session->setFlash('error', Yii::t('lang', 'Unable to create more than one administrator!!!'));
                return $this->render('create', ['model' => $model]);
            }
            $model->setPassword($model->password);
            $model->generateAuthKey();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $admin = User::find(['role' => User::ROLE_ADMIN])->one();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->id == $admin->id && $model->status == 0) {
                Yii::$app->session->setFlash('error', Yii::t('lang', 'Unable to set admin status to disabled!!!'));
                return $this->redirect(['update', 'id' => $model->id]);
            }
            if ($model->id == $admin->id && $model->role == User::ROLE_USER) {
                Yii::$app->session->setFlash('error', Yii::t('lang', 'Unable to change admin role to user!!!'));
                return $this->redirect(['update', 'id' => $model->id]);
            }
            if ($model->id != $admin->id && $model->role == User::ROLE_ADMIN) {
                Yii::$app->session->setFlash('error', Yii::t('lang', 'Unable to set admin role for user!!!'));
                return $this->redirect(['update', 'id' => $model->id]);
            }
            if ($model->id == $admin->id && !empty($model->password) && !empty($model->new_password)) {// Change password for admin
                if ($admin->validatePassword($model->password)) {
                    $model->setPassword($model->new_password);
                    $model->generateAuthKey();
                    Yii::$app->session->setFlash('success', Yii::t('lang', 'Password successfully updated!!!'));
                }
            }
            if ($model->id != $admin->id  && !empty($model->new_password)) {// Change password for user
                    $model->setPassword($model->new_password);
                    $model->generateAuthKey();
                    Yii::$app->session->setFlash('success', Yii::t('lang', 'Password successfully updated!!!'));
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lang', 'The requested page does not exist.'));
    }
}
