<?php
//use yii\helpers\Url;
use yii\helpers\Html;
?>
<li class="dropdown">
    <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
        <?= Html::img('@web/images/flagicons/'.$current.'.png').'&nbsp;'.$current; ?><span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
    <?php foreach ($languages as $lang_url => $lang): ?>
        <li><?= Html::a(Html::img('@web/images/flagicons/'.$lang.'.png').'&nbsp;'.$lang, array_merge(
                \Yii::$app->request->get(),
                ['/'.\Yii::$app->controller->route, 'language' => $lang_url]
                ));
            ?></li>
    <?php endforeach; ?>
    </ul>
</li>

