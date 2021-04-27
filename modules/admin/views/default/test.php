<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Admin panel'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = Yii::t('lang', 'Test');
?>
<div class="row">
    <div class="col-sm-9 col-md-9">
        <p>
            <b>File: </b><code><?= __FILE__ ?></code><br />
            <b>Dir: </b><code><?= __DIR__ ?></code><br />
            <b>$this->context->action->uniqueId: </b><code><?= $this->context->action->uniqueId ?></code><br />
            <b>$this->context->action->id: </b><code><?= $this->context->action->id ?></code><br />
            <b>get_class($this->context): </b><code><?= get_class($this->context) ?></code><br />
            <b>$this->context->module->id: </b><code><?= $this->context->module->id ?></code><br />
            <b>Yii::$app->user->identity->username: </b><code><?= Yii::$app->user->identity->username ?></code><br />
            <b>Yii::$app->user->identity->role: </b><code><?= Yii::$app->user->identity->role ?></code><br />
            <b>Yii::$app->setting->get('CACHE.TIME_MENU'): </b><code><?php echo Yii::$app->setting->get('CACHE.TIME_MENU') ?></code><br />
            <b>Yii::$app->urlManager->createAbsoluteUrl(''): </b><code><?= Yii::$app->urlManager->createAbsoluteUrl('') ?></code><br />
            <b>Yii::$app->controller->route: </b><code><?= Yii::$app->controller->route ?></code><br />
            <b>Url::home(): </b><code><?= Url::home() ?></code><br />
            <b>Url::base(): </b><code><?= Url::base() ?></code><br />
            <b>Yii::$app->homeUrl: </b><code><?= Yii::$app->homeUrl ?></code><br />
            <b>Url::canonical(): </b><code><?= Url::canonical() ?></code><br />
            <b>time() </b><?= time() ?><br />
            <b>Yii::$app->request->hostInfo: </b><code><?= Yii::$app->request->hostInfo ?></code><br />
            <b>Yii::$app->request->get(): </b><?php echo debug(Yii::$app->request->get()) ?><br />

        </p>
        <?php
    //        Yii::$app->setting->add([
    //            'param' => 'LANGUAGES',
    //            'label' => 'Application languages',
    //            'value' => 'a:3:{i:1;a:4:{s:7:"default";i:1;s:4:"name";s:20:"Українська";s:3:"url";s:2:"uk";s:5:"local";s:5:"uk-UA";}i:2;a:4:{s:7:"default";i:0;s:4:"name";s:7:"English";s:3:"url";s:2:"en";s:5:"local";s:5:"en-GB";}i:3;a:4:{s:7:"default";i:0;s:4:"name";s:14:"Русский";s:3:"url";s:2:"ru";s:5:"local";s:5:"ru-RU";}}',
    //            'default' => 'a:2:{i:1;a:4:{s:7:"default";i:1;s:4:"name";s:20:"Українська";s:3:"url";s:2:"uk";s:5:"local";s:5:"uk-UA";}i:2;a:4:{s:7:"default";i:0;s:4:"name";s:7:"English";s:3:"url";s:2:"en";s:5:"local";s:5:"en-GB";}}',
    //            'type' => 'text',
    //        ]);
        ?>

        <?= Html::a('Link - Html Helper', ['/about']) ?><br />
        <a href="<?= Url::to(['site/about']) ?>">link - Url Helper</a><br />

        <?php
        $options = ['class' => 'btn btn-success'];
        $lang = Yii::$app->language;
        $lang2 = array_search($lang, Yii::$app->components['urlManager']['languages']);
        echo Html::tag('div', $lang, $options);
        echo Html::tag('div', $lang2, $options);
        debug(Yii::$app->components['urlManager']['languages']);
        debug(Yii::$app->urlManager->languages);

        $arrLanguages = Yii::$app->setting->get('LANGUAGES');
        debug($arrLanguages);

    //    $dir = Yii::getAlias('@app/web/assets');
    //    echo $dir;
    //   $model = [0 => Yii::t('lang', 'Any')] + \app\models\Apartment::find()
    //                        ->select('floor')
    //                        ->groupBy('floor')
    //           ->indexBy('floor')
    //                        ->column();
    //    debug($model);
        ?>

    </div>
</div>

