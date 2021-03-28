<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name.' - Admin Panel',
        'brandUrl' => Url::to(['/'.$this->context->module->id]),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => Yii::t('lang', 'Site'), 'url' => ['/']],
            '<li class="dropdown">'."\n"
            .'<a class="dropdown-toggle" href="#" data-toggle="dropdown">'."\n"
            .'<span class="glyphicon glyphicon-cog"></span>'."\n"
            .    Yii::t('lang', 'Admin panel') . ' '
            .    '<b class="caret"></b>'."\n"
            .'</a>'."\n"
            .'<ul class="dropdown-menu">'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-list-alt"></span>'. ' ' . Yii::t('lang', 'Static pages'), ['/admin/static-page'])."\n"
            .    '</li>'."\n"
            .    '<li class="divider"></li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-list-alt"></span>'. ' ' . Yii::t('lang', 'Article categories'), ['/admin/article-category'])."\n"
            .    '</li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-list-alt"></span>'. ' ' . Yii::t('lang', 'Articles'), ['/admin/article'])."\n"
            .    '</li>'."\n"
            .    '<li class="divider"></li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-heart"></span>'. ' ' . Yii::t('lang', 'Doctors category'), ['/admin/doctor-category'])."\n"
            .    '</li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-heart"></span>'. ' ' . Yii::t('lang', 'Doctors specialization'), ['/admin/doctor-specialization'])."\n"
            .    '</li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-heart"></span>'. ' ' . Yii::t('lang', 'Doctors'), ['/admin/doctor'])."\n"
            .    '</li>'."\n"
            .    '<li class="divider"></li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-globe"></span>'. ' ' . Yii::t('lang', 'Regions'), ['/admin/region'])."\n"
            .    '</li>'."\n"
            .    '<li class="divider"></li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-tent"></span>'. ' ' . Yii::t('lang', 'Department types'), ['/admin/department-type'])."\n"
            .    '</li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-tent"></span>'. ' ' . Yii::t('lang', 'Departments'), ['/admin/department'])."\n"
            .    '</li>'."\n"
            .    '<li class="divider"></li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-user"></span>'. ' ' . Yii::t('lang', 'Users'), ['/admin/user'])."\n"
            .    '</li>'."\n"
            .    '<li class="divider"></li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-piggy-bank"></span>'. ' ' . Yii::t('lang', 'Banners'), ['/admin/banner'])."\n"
            .    '</li>'."\n"
            .    '<li class="divider"></li>'."\n"
            .    '<li>'."\n"
            .        Html::a('<span class="glyphicon glyphicon-cog"></span>'. ' ' . Yii::t('lang', 'Settings'), ['/admin/setting'])."\n"
            .    '</li>'."\n"
            .'</ul>'."\n"
            .'</li>',
            //Yii::$app->user->isGuest ? (
                //['label' => Yii::t('lang', 'Login'), 'url' => ['/site/login']]
            //) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(Yii::t('lang', 'Logout').' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            //)
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            app\widgets\LanguageWidget::widget(),
            // Пошук - варіант перший
            //'<form class="navbar-form navbar-right">'
            //.'<input class="form-control" placeholder="Пошук..." type="text">'
            //.'</form>'

            // Пошук - варіант другий
            // Html::beginForm(['/site/search'], 'post', ['class' => 'navbar-form navbar-right'])
            // .Html::input('text', 'search', '', ['placeholder' => 'Пошук...'])
            // .Html::endForm()
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
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name?> 2018 <?= '- '.date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered().'&nbsp;-&nbsp;'.Html::a('Yurii Radio', 'https://github.com/YuriiRadio', ['target' => '_blank']) ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>