<?php
//use yii\helpers\Html;

/* @var $this yii\web\View */

//$siteLink = Yii::$app->urlManager->createAbsoluteUrl(['site/contact']);
//$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css');
?>

<?php // echo Html::encode($siteLink) ?>

<style>
#print-content {
  font-size: 15px;
}

table {
    width: 100% !important;
    margin-bottom: 10px;
    border-collapse: collapse;
}

table td, table th {
  padding: 5px;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}
</style>

<div id="print-invoice-content">
    <table class="table table-hover">
        <tr>
            <td><?= date('d.m.Y', $model->created_at) ?><br><?= preg_replace('#^https?://#', '', Yii::$app->urlManager->getHostInfo()) ?></td>
            <td colspan="2"><b><span style="font-size: 25px">Рахунок<?= ' #' . $model->id ?></span> (на оплату лабораторних досліджень)</b></td>
        </tr>
        <tr>
            <td><b>Одержувач:</b></td>
            <td colspan="2"><b>КНП&nbsp;&quot;Березнівський ЦПМД&quot;</b> (34600, Рівненська обл., м.Березне, вул.Набережна, 3)</td>
        </tr>
        <tr>
            <td><b>ЄДРПОУ одержувача:</b></td>
            <td colspan="2">37867877</td>
        </tr>
        <tr>
            <td><b>IBAN одержувача:</b></td>
            <td colspan="2">UA133204780000026007924441234</td>
        </tr>
        <tr>
            <td><b>Банк одержувача (МФО, Назва):</b></td>
            <td colspan="2">320478, ПАТ Акціонерний Банк &quot;УКРГАЗБАНК&quot;</td>
        </tr>
        <tr>
            <td><b>Призначення платежу:</b></td>
            <td colspan="2">За пакети досліджень: <b><?= $model->analyses_packages_nums ?></b></td>
        </tr>
        <tr>
            <td><b>Платник:</b></td>
            <td colspan="2"><b><?= $model->patient->name ?></b></td>
        </tr>
        <tr>
            <td><b>Сума:</b></td>
            <td colspan="2"><b><?php echo number_format($sum, 2, ',', '') . ' грн.'; ?></b></td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <table class="table table-hover">
        <thead>
            <th><b>#</b></th>
            <th><b><?= Yii::t('lang', 'Package number') ?></b></th>
            <th><b><?= Yii::t('lang', 'Title') ?></b></th>
            <th><b><?= Yii::t('lang', 'Cost') ?></b></th>
        </thead>
        <?php $i = 1; foreach ($analyses_packages as $analys_package): ?>
            <tr>
                <td><?= $i ?></td>
                <td><b><?= $analys_package['pac_num'] ?></b></td>
                <td><?= $analys_package['title'] . '&nbsp;' . '(' . count(explode(',', $analys_package['analyses_ids'])) . ')' ?></td>
                <td <?= ($model->patient->our_patient && $analys_package['is_free']) ? 'style="text-decoration: line-through"' : '' ?>><?= number_format($analys_package['cost'], 2, ',', '') ?></td>
            </tr>
        <?php $i++; endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: right"><b><?= Yii::t('lang', 'Total') ?>:</b></td>
                <td><?php echo number_format($sum, 2, ',', '') . ' грн.'; ?></td>
            </tr>
    </table>
</div>