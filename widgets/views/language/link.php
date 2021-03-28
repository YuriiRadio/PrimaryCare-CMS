<?php
use yii\helpers\Url;
//use yii\helpers\Html;
$host = Yii::$app->request->hostInfo; // Домен сайту
?>
<link rel="alternate" hreflang="<?= $current ?>" href="<?= $host.Url::to(array_merge(\Yii::$app->request->get(), ['/'.\Yii::$app->controller->route, 'language' => $current])) ?>" />
<?php foreach ($languages as $lang_url => $lang): ?>
    <link rel="alternate" hreflang="<?= $lang ?>" href="<?= $host.Url::to(array_merge(\Yii::$app->request->get(), ['/'.\Yii::$app->controller->route, 'language' => $lang_url])) ?>" />
<?php endforeach; ?>