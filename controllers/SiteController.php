<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
//use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\StaticPage;
use app\models\StaticPageI18n;
use app\models\Sitemap;

class SiteController extends AppController {

    /**
     * @inheritdoc
     * Поведінка
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'search' => ['post'],
                ],
            ],
                //Кешування сторінок
//            'pageCache' => [
//                'class' => 'yii\filters\PageCache',
//                'only' => ['index'],
//                //'duration' => 60,
//                'duration' => Yii::$app->setting->get('TIME_CACHE_PAGE'),
//                'variations' => [Yii::$app->language]
//            ],
                //End Кешування
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 9,
                'maxLength' => 9,
                'width' => 130,
                'height' => 40,
                'transparent' => true,
                'offset' => -1,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
//        $this->setMeta('Yii2-PMD', 'key', 'desk');
//        return $this->render('index');
        return $this->goHome();
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        //$remote_ip = @$_SERVER["REMOTE_ADDR"];

        $model = new ContactForm();
        $model->ip = Yii::$app->request->userIP;

        // Get cache
        $model_db = Yii::$app->cache->get('systemPage-contact-' . Yii::$app->language);
        if (!$model_db) {
            $model_db = StaticPage::find()
                    ->innerJoin(StaticPageI18n::tableName(), '`' . StaticPageI18n::tableName() . '`.`static_page_id` = `' . StaticPage::tableName() . '`.`id`')
                    ->select([
                        StaticPage::tableName() . '.id',
                        StaticPage::tableName() . '.alias',
                        StaticPageI18n::tableName() . '.title',
                        StaticPageI18n::tableName() . '.body',
                        StaticPageI18n::tableName() . '.keywords',
                        StaticPageI18n::tableName() . '.description',
                    ])
                    ->where('((`alias` = :page_alias) AND (`status` = :status) AND (`language` = :language))')
                    ->addParams([':page_alias' => 'contact'])
                    ->addParams([':status' => StaticPage::STATUS_ACTIVE])
                    ->addParams([':language' => Yii::$app->language])
                    ->limit(1)
                    ->asArray()
                    ->one();
            // Set cache
            if (!is_null($model_db)) {
                Yii::$app->cache->set('systemPage-contact-' . Yii::$app->language, $model_db, Yii::$app->setting->get('CACHE.TIME_PAGE'));
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //if ($model->contactEmail(Yii::$app->params['adminEmail'])) {
            if ($model->contactEmail(Yii::$app->setting->get('EMAIL.SUPPORT_EMAIL'))) {
                Yii::$app->session->setFlash('success', Yii::t('lang', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('lang', 'There was an error sending email.'));
            }

            return $this->refresh();
        } else {
            if (!is_null($model_db)) {
                $this->setMeta($model_db['title'], $model_db['keywords'], $model_db['description']);
            } else {
                $this->setMeta(Yii::t('lang', 'Contact'), Yii::$app->setting->get('SITE.KEYWORDS'), Yii::$app->setting->get('SITE.DESCRIPTION'));
            }

            return $this->render('contact', [
                        'model' => $model,
                        'model_db' => $model_db,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        if (Yii::$app->request->isAjax) {
            return 'Ok About!!!';
        }
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
//        Розкоментувати щоб ввімкнути реєстрацію
        $model = new SignupForm();
//        if ($model->load(Yii::$app->request->post())) {
//            if ($user = $model->signup()) {
//                if (Yii::$app->getUser()->login($user)) {
//                    return $this->goHome();
//                }
//            }
//        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('lang', 'Check your email for further instructions.'));
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('lang', 'Sorry, we are unable to reset password for email provided.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('lang', 'New password was saved.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionDepartmentsMap() {

        $models = \app\models\Department::find()
                ->with('i18n')
                ->where(['status' => \app\models\Department::STATUS_ACTIVE])
                ->asArray()
                ->all();

        $this->setMeta(Yii::t('lang', 'Map'), Yii::t('lang', 'Map').', '.Yii::$app->setting->get('SITE.KEYWORDS'), Yii::$app->setting->get('SITE.DESCRIPTION'));
        return $this->render('departmentsMap', ['models' => $models]);
    }

    /**
     * Displays static pages.
     *
     * @return string
     * @author Yurii Radio <yurii.radio@gmail.com>
     */
    public function actionStatic($alias = null) {
        if ($alias === null) {
            throw new \yii\web\HttpException(404, Yii::t('lang', 'The requested page does not exist.'));
        }

        $alias = clearGetData($alias);

        if ($alias == 'contact') {// Забороняємо пошук системної сторінки
            throw new \yii\web\HttpException(404, Yii::t('lang', 'The requested page does not exist.'));
        }

        // Get cache
        $model = Yii::$app->cache->get('staticPage-' . $alias . Yii::$app->language);
        if ($model) {
            $this->setMeta($model['title'], $model['keywords'], $model['description']);
            if (isset($model['og_image'])) {
            $this->view->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->request->hostInfo.$model['og_image']]);
        }
            return $this->render('static', ['model' => $model]);
        }

        // Get record from Database
        // Цей спосіб використовує більше запитів до Db
//        $model = StaticPage::find()
//            ->joinWith('i18n')
//            ->where('((`alias` = :page_alias) AND (`status` = :status))')
//            ->addParams([':page_alias' => $alias])
//            ->addParams([':status' => StaticPage::STATUS_ACTIVE])
//            ->one();
//        return $this->render('static', ['model' => $model]);
        // Цей спосіб використовує меньше запитів до Db
        $model = StaticPage::find()
                ->innerJoin(StaticPageI18n::tableName(), '`' . StaticPageI18n::tableName() . '`.`static_page_id` = `' . StaticPage::tableName() . '`.`id`')
                ->select([
                    StaticPage::tableName() . '.id',
                    StaticPage::tableName() . '.alias',
                    StaticPage::tableName() . '.og_image',
                    StaticPageI18n::tableName() . '.title',
                    StaticPageI18n::tableName() . '.body',
                    StaticPageI18n::tableName() . '.keywords',
                    StaticPageI18n::tableName() . '.description',
                ])
                ->where('((`alias` = :page_alias) AND (`status` = :status) AND (`language` = :language))')
                ->addParams([':page_alias' => $alias])
                ->addParams([':status' => StaticPage::STATUS_ACTIVE])
                ->addParams([':language' => Yii::$app->language])
                ->limit(1)
                ->asArray()
                ->one();
        if (!$model) {
            throw new \yii\web\HttpException(404, Yii::t('lang', 'The requested page does not exist.'));
        }

//        $model = Yii::$app->db->createCommand(
//            'SELECT * FROM `'.StaticPage::tableName().'`, `'.StaticPageI18n::tableName().'`'
//          . ' WHERE (`'.StaticPage::tableName().'`.`id` = `'.StaticPageI18n::tableName().'`.`static_page_id`)'
//          . ' AND (`'.StaticPage::tableName().'`.`status` = :status)'
//          . ' AND (`'.StaticPage::tableName().'`.`alias` = :alias)'
//          . ' AND (`'.StaticPageI18n::tableName().'`.`language_id` = :language_id)',
//          [
//              ':status' => StaticPage::STATUS_ACTIVE,
//              ':alias' => $alias,
//              ':language_id' => Language::getCurrent()->id
//          ]
//        )->queryOne();
        // Set cache
        Yii::$app->cache->set('staticPage-' . $alias . Yii::$app->language, $model, Yii::$app->setting->get('CACHE.TIME_PAGE'));
        $this->setMeta($model['title'], $model['keywords'], $model['description']);
        if (isset($model['og_image'])) {
            $this->view->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->request->hostInfo.$model['og_image']]);
        }
        return $this->render('static', ['model' => $model]);
    }

    // Карта сайта. Виводимо в вигляді XML файлу.
    public function actionSitemap() {
        $sitemap = new Sitemap();

        // Спробуємо дістати з кешу
        if (!$xml_sitemap = Yii::$app->cache->get('sitemap')) {
            // Масив посилань
            $urls = $sitemap->getUrl();
            // Формуємо XML файл
            $xml_sitemap = $sitemap->getXml($urls);
            // Кешуємо результат
            Yii::$app->cache->set('sitemap', $xml_sitemap, Yii::$app->setting->get('CACHE.TIME_PAGE'));
        }

        // Виводимо карту сайту
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        //header_remove();
        header("Content-Type: text/xml; charset=utf-8");

        return $xml_sitemap;
    }


    /**
     * Displays search page.
     *
     * @return string
     */
    public function actionSearch() {

        $str = Yii::$app->request->post('search');

        $model = new \app\models\SiteSearch($str);

//        $doctors = \app\models\Doctor::find()
//                ->joinWith('i18n')
//                ->where('`name` LIKE :name AND `status` = :status',
//                        [':name' => '%габо%', ':status' => \app\models\Doctor::STATUS_ACTIVE])
//                ->all();
//        debug($doctors);

        if ($model->validate()) {
            $model->search();
            return $this->render('search', ['model' => $model]);
        }

        Yii::$app->session->setFlash('error', Yii::t('lang', 'Bad request!!!'));
        return $this->goHome();
    }

}
