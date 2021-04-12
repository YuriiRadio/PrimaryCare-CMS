<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
//use yii\widgets\Breadcrumbs;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css', ['depends' => ['yii\bootstrap4\BootstrapAsset']]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <meta name="author" content="yurii.radio@gmail.com">
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="/web/images/doctor-icon.png" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name.' - Admin Panel',
            'brandUrl' => Url::to(['/'.$this->context->module->id]),
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav mr-auto'],
            'items' => [
                ['label' => Yii::t('lang', 'Site'), 'url' => ['/']],
                ['label' => '<i class="bi bi-gear"></i>&nbsp;' . Yii::t('lang', 'Admin panel'), [], 'encode' => false,
                    'items' => [
                        ['label' => '<i class="bi bi-journal-text"></i>&nbsp;' . Yii::t('lang', 'Static pages'), 'url' => '/admin/static-page', 'encode' => false],
                        '<div class="dropdown-divider"></div>',
                         //'<div class="dropdown-header">Dropdown Header</div>',
                        ['label' => '<i class="bi bi-journal-text"></i>&nbsp;' . Yii::t('lang', 'Article categories'), 'url' => '/admin/article-category', 'encode' => false],
                        ['label' => '<i class="bi bi-journal-text"></i>&nbsp;' . Yii::t('lang', 'Articles'), 'url' => '/admin/article', 'encode' => false],
                        '<div class="dropdown-divider"></div>',
                        ['label' => '<i class="bi bi-heart-half"></i>&nbsp;' . Yii::t('lang', 'Doctors category'), 'url' => '/admin/doctor-category', 'encode' => false],
                        ['label' => '<i class="bi bi-heart-half"></i>&nbsp;' . Yii::t('lang', 'Doctors specialization'), 'url' => '/admin/doctor-specialization', 'encode' => false],
                        ['label' => '<i class="bi bi-heart-half"></i>&nbsp;' . Yii::t('lang', 'Doctors'), 'url' => '/admin/doctor', 'encode' => false],
                        '<div class="dropdown-divider"></div>',
                        ['label' => '<i class="bi bi-map-fill"></i>&nbsp;' . Yii::t('lang', 'Regions'), 'url' => '/admin/region', 'encode' => false],
                        '<div class="dropdown-divider"></div>',
                        ['label' => '<i class="bi bi-building"></i>&nbsp;' . Yii::t('lang', 'Department types'), 'url' => '/admin/department-type', 'encode' => false],
                        ['label' => '<i class="bi bi-house"></i>&nbsp;' . Yii::t('lang', 'Departments'), 'url' => '/admin/department', 'encode' => false],
                        '<div class="dropdown-divider"></div>',
                        ['label' => '<i class="bi bi-people"></i>&nbsp;' . Yii::t('lang', 'Users'), 'url' => '/admin/user', 'encode' => false],
                        '<div class="dropdown-divider"></div>',
                        ['label' => '<i class="bi bi-briefcase"></i>&nbsp;' . Yii::t('lang', 'Banners'), 'url' => '/admin/banner', 'encode' => false],
                        '<div class="dropdown-divider"></div>',
                        ['label' => '<i class="bi bi-gear"></i>&nbsp;' . Yii::t('lang', 'Settings'), 'url' => '/admin/setting', 'encode' => false],
                    ],
                ],

                '<li class="nav-item">'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(Yii::t('lang', 'Logout').' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link nav-link']
                )
                . Html::endForm()
                . '</li>',
            ],
        ]);

        echo Nav::widget([
                'options' => ['class' => 'navbar-nav mr-auto'],
                'items' => [
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
    </div>
</div>

<footer>
    <div class="container">
        <p class="float-right"><?= Yii::powered().'&nbsp;-&nbsp;'.Html::a('Yurii Radio', 'https://github.com/YuriiRadio', ['target' => '_blank']) ?></p>
        <p>
            &copy; <?= Yii::$app->name?> 2018 <?= '- '.date('Y') ?><?= app\widgets\StaticPageMenuWidget::widget(['position' => 'footer']) ?>|&nbsp;<a href="/sitemap.xml">Sitemap</a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>