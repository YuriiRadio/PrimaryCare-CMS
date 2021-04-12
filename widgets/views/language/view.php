<?php
//use yii\helpers\Url;
use yii\helpers\Html;
?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" title="<?= $current_lang['local'] ?>">
        <?= Html::img('@web/images/flagicons/'.$current_lang['local'].'.png').'&nbsp;'.$current_lang['name']; ?>
    </a>
    <div class="dropdown-menu">
    <?php foreach ($lang_arr as $lang): ?>
        <?= Html::a(Html::img('@web/images/flagicons/'.$lang['local'].'.png').'&nbsp;'.$lang['name'], array_merge(
            \Yii::$app->request->get(),
            ['/'.\Yii::$app->controller->route, 'language' => $lang['url']]
            ), ['class' => 'dropdown-item', 'title' => $lang['local']]);
        ?>
    <?php endforeach; ?>
    </div>
</li>

