<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$siteLink = Yii::$app->urlManager->createAbsoluteUrl(['site/contact']);

?>
<div class="contact-form-mail">
    <p><b>Sender name:</b>&nbsp;<?= Html::encode($name) ?></p>
    <p><b>Sender E-mail:</b>&nbsp;<?= $email ?></p>
    <p><b><?= Yii::t('lang','Sender IP address').': ' ?></b><?= Html::encode($ip) ?></p>
    <p><b>Sender Message:</b><pre><?= $body ?></pre></p>

    <br /><hr />
    <p><b><?= Yii::t('lang','Message from site')?>:</b>&nbsp;<?=Html::a(Html::encode($siteLink), $siteLink) ?></p>
    <h3><font color="red">
        <font color="red">Be careful these can be criminals, do not go to any links!!!</font><br />
        <font color="#FF8C00">Будьте обережні, це можуть бути злочинці, не переходьте на будь-які посилання!!!</font><br /><br />

        <font color="red">Do not download any files!!! There may be viruses...</font><br />
        <font color="#FF8C00">Не завантажуйте жодних файлів!!! Це можуть бути віруси...</font><br /><br />

        <font color="red">Email addresses can be fictitious!!! Do not respond to it unless it is credible...</font><br />
        <font color="#FF8C00">Адреси електронної пошти можуть бути вигаданими!!! Не відповідайте на нах, якщо це не є достовірним...</font><br />
    </h3>
</div>