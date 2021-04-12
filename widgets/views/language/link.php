<?php
use yii\helpers\Url;
//use yii\helpers\Html;
$host = Yii::$app->request->hostInfo; // Домен сайту
?>
<?php foreach ($lang_arr as $lang): ?>
<link rel="alternate" hreflang="<?= $lang['local'] ?>" href="<?= $host.Url::to(array_merge(\Yii::$app->request->get(), ['/'.\Yii::$app->controller->route, 'language' => $lang['url']])) ?>" />
<?php endforeach; ?>