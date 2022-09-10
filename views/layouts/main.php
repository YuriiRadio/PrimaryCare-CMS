<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;
use app\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use app\widgets\Alert;

AppAsset::register($this);
$this->registerJsFile('@web/js/share42/share42.js', ['depends' => ['yii\web\YiiAsset']]);
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css', ['depends' => ['yii\bootstrap4\BootstrapAsset']]);
$this->registerCssFile('https://use.fontawesome.com/releases/v5.3.1/css/all.css', ['depends' => ['yii\bootstrap4\BootstrapAsset']]);

#******New Year*****
//$this->registerJsFile('@web/js/jquery.snow.js', ['depends' => ['yii\web\YiiAsset', 'yii\bootstrap\BootstrapAsset']]);
#******End New Year*****

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <meta name="author" content="Yurii Radio" />
    <meta property="og:title" content="<?= Html::encode($this->title) ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="/web/images/doctor-icon.png" type="image/x-icon">
    <?= app\widgets\LanguageWidget::widget(['type' => 'alternate']) ?>
    <?php if (Yii::$app->setting->get('SITE.HEAD') != 'false') echo Yii::$app->setting->get('SITE.HEAD')."\n"; ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <header>
        <!--#******New Year*****-->
        <span class="new_year_logo"></span>
        <!--#******End New Year*****-->
        <span class="logo_icon"></span>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-xl navbar-dark bg-dark',
            ],
        ]);

        $items = [];
        if (Yii::$app->user->isGuest) {
            $items = ['label' => '<i class="bi bi-key"></i>&nbsp;' . Yii::t('lang', 'Login'), 'url' => ['/site/login'], 'encode' => false];
        } elseif (Yii::$app->user->identity->isAdmin()) {
            $items = ['label' => '<i class="bi bi-gear"></i>&nbsp;' . Yii::t('lang', 'Admin panel'), 'url' => ['/admin'], 'encode' => false];
        } elseif (Yii::$app->user->identity->isDoctor()) {
            $items = ['label' => '<i class="bi bi-journal-text"></i>&nbsp;' . Yii::t('lang', 'Analyses Orders'), [], 'encode' => false,
                'items' => [
                    ['label' => '<i class="bi bi-people"></i>&nbsp;' . Yii::t('lang', 'Patients'), 'url' => ['/doctor-analyses/patients'], 'encode' => false],
                    ['label' => '<i class="bi bi-gear"></i>&nbsp;' . Yii::t('lang', 'Analyses Orders'), 'url' => ['/doctor-analyses/analyses-orders'], 'encode' => false],
                ]
            ];
        } elseif (Yii::$app->user->identity->isLaborant()) {
            $items = ['label' => '<i class="bi bi-journal-text"></i>&nbsp;' . Yii::t('lang', 'Analyses Orders'), 'url' => ['/laborant-analyses/analyses-orders'], 'encode' => false];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav mr-auto'],
            'items' => [
                ['label' => Yii::t('lang', 'Home'), 'url' => ['/']],
                app\widgets\StaticPageMenuWidget::widget(['position' => 'header']),
                ['label' => '<i class="bi bi-mailbox"></i>&nbsp;' . Yii::t('lang', 'Contact Us'), 'url' => ['/site/contact'], 'encode' => false],
                ['label' => '<i class="bi bi-map"></i>&nbsp;' . Yii::t('lang', 'Map'), 'url' => ['/site/departments-map'], 'encode' => false],
                ['label' => '<i class="bi bi-journal-text"></i>&nbsp;' . Yii::t('lang', 'Analyses'), 'url' => ['/site/analyses'], 'encode' => false],
                $items,
                !Yii::$app->user->isGuest ? (
                    '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(Yii::t('lang', 'Logout').' (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link nav-link'])
                    . Html::endForm()
                    . '</li>')
                : (''),
            ],
        ]);

        echo Nav::widget([ # Пошук
            'options' => ['class' => 'navbar-nav ml-md-auto'],
            'items' => [
                Html::beginForm(['/site/search'], 'post', ['class' => 'form-inline'])
                .Html::input('text', 'search', '', ['placeholder' => Yii::t('lang', 'Search').'... (>=4)', 'size' => 6, 'class' => 'form-control'])
                .Html::endForm(),
                app\widgets\LanguageWidget::widget(),
            ]
        ]);
        NavBar::end();
        ?>
    </header>

    <div class="container">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <div class="row">
            <div class="col-12">
                <div class="share42init float-right" data-description="КНП Березнівський Центр ПМД" data-title="КНП Березнівський Центр ПМД"></div>
            </div>
        </div>
    </div>

</div>

<footer>
    <div class="container">
        <p class="float-right"><?= Yii::powered().'&nbsp;-&nbsp;'.Html::a('Yurii Radio', 'https://github.com/YuriiRadio', ['target' => '_blank']) ?></p>
        <p>
            &copy; <?= Yii::$app->name ?> 2018 <?= '- '.date('Y') ?><?= app\widgets\StaticPageMenuWidget::widget(['position' => 'footer']) ?>|&nbsp;<a href="/sitemap.xml">Sitemap</a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>