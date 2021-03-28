<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
//use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('@web/js/share42/share42.js', ['depends' => ['yii\web\YiiAsset', 'yii\bootstrap\BootstrapAsset']]);

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

<div class="wrap">
    <!--#******New Year*****-->
    <span class="new_year_logo"></span>
    <!--#******End New Year*****-->
    <span class="logo_icon"></span>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav navbar-left'],
        'items' => [
            ['label' => Yii::t('lang', 'Home'), 'url' => ['/']],
            app\widgets\StaticPageMenuWidget::widget(['position' => 'header']),
            //['label' => 'About', 'url' => ['/site/about']],
            ['label' => '<span class="glyphicon glyphicon-envelope"></span>&nbsp;' . Yii::t('lang', 'Contact Us'), 'url' => ['/site/contact'], 'encode' => false],
            ['label' => '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;' . Yii::t('lang', 'Map'), 'url' => ['site/departments-map/'], 'encode' => false],
            Yii::$app->user->isGuest ? (
                ['label' => Yii::t('lang', 'Login'), 'url' => ['/site/login']]
            ) : (
                (Yii::$app->user->identity->isAdmin() ? (
                    '<li>'
                    //.'<a href='.Url::to(['/admin']).'><span class="glyphicon glyphicon-cog"></span>'.'&nbsp;'.Yii::t('lang', 'Admin panel').'</a>'
                    .   Html::a('<span class="glyphicon glyphicon-cog"></span>' . '&nbsp;' . Yii::t('lang', 'Admin panel'), ['/admin'])."\n"
                    .'</li>'
                ) : '')
                .'<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(Yii::t('lang', 'Logout').' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav navbar-right'],
        'items' => [
            // Пошук - варіант другий
            Html::beginForm(['/site/search'], 'post', ['class' => 'navbar-form navbar-left'])
            .Html::input('text', 'search', '', ['placeholder' => Yii::t('lang', 'Search').'... >= 4', 'size' => 7, 'class' => 'form-control'])
            .Html::endForm(),
            app\widgets\LanguageWidget::widget(),
            // Пошук - варіант перший
            //'<form class="navbar-form navbar-right">'
            //.'<input class="form-control" placeholder="Пошук..." type="text">'
            //.'</form>'
        ]
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <div class="row">
            <div class="share42init pull-right" data-description="КНП Березнівський Центр ПМД" data-title="КНП Березнівський Центр ПМД"></div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name?> 2018 <?= '- '.date('Y') ?></p>
        <p class="pull-left"><?= app\widgets\StaticPageMenuWidget::widget(['position' => 'footer']) ?>|&nbsp;<a href="/sitemap.xml">Sitemap</a></p>
        <p class="pull-right"><?= Yii::powered().'&nbsp;-&nbsp;'.Html::a('Yurii Radio', 'https://github.com/YuriiRadio', ['target' => '_blank']) ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>