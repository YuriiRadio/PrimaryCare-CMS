<?php
use yii\helpers\Html;

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

<div id="print-content">
    <table>
        <tbody>
            <tr>
                <td style="font-size: 12px">
                    Ліцензія&nbsp;на медичну практику:<br />
                    <b>1265</b> від <b>05.07.2018</b>
                </td>
                <td colspan="2">
                    <p style="text-align: center"><b>КНП &quot;БЕРЕЗНІВСЬКИЙ ЦЕНТР ПМД&quot;</b></p>
                    <p><em>34600, Рівненська обл., Рівненський район, місто Березне, вул. Набережна, будинок 3</em></p>
                </td>
            </tr>
            <tr>
                <td><?= Yii::t('lang', 'Order') ?>:<b><?= ' #' . $model->id ?></b> від&nbsp;<b><?= date('d.m.Y', $model->created_at) ?></b></td>
                <td colspan="2"><?= Yii::t('lang', 'Patient') ?>:&nbsp;<b><?= $model->patient->name ?></b></td>
            </tr>
            <tr>
                <td><?= Yii::t('lang', 'Date of biomaterial') ?>:&nbsp;<b><?= date('d.m.Y', $model->date_biomaterial) ?></b></td>
                <td><?= Yii::t('lang', 'Birth') ?>:&nbsp;<b><?= date('d.m.Y', strtotime($model->patient->birth)) . ' (' . substr(date('Ymd') - date('Ymd', strtotime($model->patient->birth)), 0, -4) . ')' ?></b></td>
                <td><?= Yii::t('lang', 'Sex') ?>:&nbsp;<b>
                    <?php
                        if ($model->patient->sex == 1) { echo Yii::t('lang', 'Male'); }
                        elseif ($model->patient->sex == 0) { echo Yii::t('lang', 'Female'); }
                        elseif ($model->patient->sex == 2) { echo Yii::t('lang', 'It'); }
                    ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td colspan="3"><?= Yii::t('lang', 'Doctor') ?>:&nbsp;<b><?= $model->doctor->name ?></b></td>
            </tr>
            <tr>
                <td colspan="3"><?= Yii::t('lang', 'Laborant(s)') ?>:&nbsp;<b>Іванова Іванна Іванівна</b></td>
            </tr>
        </tbody>
    </table>

    <?php if (!empty($model->analyses_values)): ?>
        <p>&nbsp;</p>
        <table>
            <tr>
                <td><b>#</b></td>
                <td><b><?= Yii::t('lang', 'Title') ?></b></td>
                <td><b><?= Yii::t('lang', 'Value') ?></b></td>
                <td><b><?= Yii::t('lang', 'Units') ?></b></td>
                <td><b><?= Yii::t('lang', 'Normal') ?></b></td>
            </tr>
            <?php $i = 1; $old_cat_title = ''; foreach ($analyses as $analys): ?>
                <?php if ($old_cat_title != $analys['cat_title']): ?>
                    <tr>
                        <td colspan="5" style="text-align: center"><b><?= $analys['cat_title'] ?></b></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><b><?= $i ?></b></td>
                    <td><?= $analys['title'] ?></td>
                    <td style="font-size: 20px;"><b><?= json_decode($model->analyses_values, true)[$analys['id']] ?></b></td>
                    <td><?= $analys['units'] ?></td>
                    <td><?= nl2br($analys['norm']) ?></td>
                </tr>
            <?php $i++; $old_cat_title = $analys['cat_title']; endforeach; ?>
        </table>
    <?php endif; ?>
    <p>Інтерпретація результатів дослідженнь проводиться лише лікарем. Діагноз не може бути встановлений тільки на підставі результатів лабораторних досліджень, також потрібні огляд пацієнта та, можливо, додаткові обстеження.</p>
</div>