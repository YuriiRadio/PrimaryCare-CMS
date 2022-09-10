<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesOrders */

$this->title = Yii::t('lang', 'Order') . ' #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Analyses Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//\yii\web\YiiAsset::register($this);

$status = '';
if ($model->status === 0) { $status = '<span class="text-primary">' . Yii::t('lang', 'New') . '</span>'; }
elseif ($model->status === 1) { $status = '<span class="text-warning">' . Yii::t('lang', 'Edited') . '</span>'; }
elseif ($model->status === 2) { $status = '<span class="text-success">' . Yii::t('lang', 'Done') . '</span>'; }

?>

<?php
    $url = \yii\helpers\Url::to(['/doctor-analyses/analyses-orders/view', 'id' => $model->id]);
    $js = <<<JS
    $('#sendInvoiceEmail').on('click', function () {
    $.ajax({
        url: "$url",
        type: 'POST',
        //data: {test: '123'},
        success: function (res) {
            if (res == 1) {
                alert("Send invoice to email - OK :)");
                //console.log(res);
                $('#sendInvoiceEmailIcon').html('<i class="bi bi-envelope-check-fill"></i>');
                $('#sendInvoiceEmail').removeClass().addClass("btn btn-success");
            } else {
                alert("Send invoice to email - ERROR!!!");
                //console.log(res);
                $('#sendInvoiceEmailIcon').html('<i class="bi bi-envelope-x-fill"></i>');
                $('#sendInvoiceEmail').removeClass().addClass("btn btn-danger");
            }
        },
        error: function () {
            alert('Error send request!!!');
            $('#sendInvoiceEmailIcon').html('<i class="bi bi-envelope-x-fill"></i>');
            $('#sendInvoiceEmail').removeClass().addClass("btn btn-danger");
        }
    });
    });
JS;
$this->registerJs($js);
?>

<script>
    function PrintElem(elem) {
        Popup($(elem).html());
    }

    function Popup(data) {
        let mywindow = window.open('', 'Print content', 'height=600,width=800');
        mywindow.document.write('<html><head><title>Print content</title>');
        mywindow.document.write('<link rel="stylesheet" href="/css/bootstrap_united.min.css" type="text/css" />');
        mywindow.document.write('</head><body>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>

<div class="analyses-orders-view">

    <h1><?= Html::encode($this->title) . ' (' . Yii::t('lang', 'status') . ' - ' . $status . ')' ?></h1>

    <p>
        <?php if ($sum > 0): ?>
            <?= Html::a('<span id="sendInvoiceEmailIcon"><i class="bi bi-envelope-fill"></i></span>&nbsp;' . Yii::t('lang', 'Send invoice to email'), null, ['class' => 'btn btn-warning', 'id' => 'sendInvoiceEmail']) ?>
            <?= Html::a('<i class="bi bi-printer-fill"></i>&nbsp;' . Yii::t('lang', 'Print Invoice'), null, ['class' => 'btn btn-warning', 'onclick' => 'PrintElem(\'#print-invoice-content\')']) ?>
        <?php endif; ?>
        <?php if ($model->status === $model::STATUS_DONE): ?>
        <?= Html::a('<i class="bi bi-printer-fill"></i>&nbsp;' . Yii::t('lang', 'Print Result'), null, ['class' => 'btn btn-info', 'onclick' => 'PrintElem(\'#print-analys-content\')']) ?>
        <?php endif; ?>
        <?php if ($model->status === $model::STATUS_NEW || $model->status === $model::STATUS_EDITED) {
                echo Html::a('<i class="bi bi-pencil-fill"></i>&nbsp;' . Yii::t('lang', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            }
        ?>
        <?php if ($model->status === $model::STATUS_NEW): ?>
            &nbsp;
            <?= Html::a('<i class="bi bi-trash-fill"></i>&nbsp;' . Yii::t('lang', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('lang', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>

    </p>

    <?php if ($sum > 0): ?>
        <div id="print-invoice-content">
            <table class="table table-hover" style="background: #ecaa1b">
                <tr>
                    <td><?= date('d.m.Y', $model->created_at) ?><br><?= preg_replace('#^https?://#', '', Yii::$app->urlManager->getHostInfo()) ?></td>
                    <td colspan="2"><b><span style="font-size: 25px">Рахунок<?= ' #' . $model->id ?></span> (на оплату лабораторних досліджень)</b></td>
                </tr>
                <tr>
                    <td><b>Одержувач:</b></td>
                    <td colspan="2"><b>КНП&nbsp;&quot;Березнівський ЦПМД&quot;</b> (34600, м. Березне, вул. Набережна, 3)</td>
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
                    <td colspan="2"><b><?= $sum . ' грн.' ?></b></td>
                </tr>
            </table>
            <table class="table table-hover" style="background: #ECAA1B">
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
                        <td><?= $analys_package['cost'] ?></td>
                    </tr>
                <?php $i++; endforeach; ?>
                    <tr>
                        <td colspan="3" style="text-align: right"><b><?= Yii::t('lang', 'Total') ?>:</b></td>
                        <td><?= $sum . ' грн.' ?></td>
                    </tr>
            </table>
        </div>
        <hr />
    <?php endif; ?>

    <div id="print-analys-content">
        <table class="table table-hover" <?= $model->status === 0 ? 'style="background: #FF9200"' : 'style="background: #00cc66"' ?>>
            <tbody>
                <tr>
                    <td style="font-size: 12px">Ліцензія&nbsp;на медичну практику:<br />
                    <b>1265</b> від <b>05.07.2018</b></td>
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
                <table class="table table-hover" <?= $model->status === $model::STATUS_NEW || $model->status === $model::STATUS_EDITED ? 'style="background: #FF9200"' : 'style="background: #00cc66"' ?>>
                    <thead>
                        <th><b>#</b></th>
                        <th><b><?= Yii::t('lang', 'Title') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Value') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Units') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Normal') ?></b></th>
                    </thead>
                        <?php $i = 1; $old_cat_title = ''; foreach ($analyses as $analys): ?>
                            <?php if ($old_cat_title != $analys['cat_title']): ?>
                                <tr>
                                    <td colspan="5" style="text-align: center"><b><?= $analys['cat_title'] ?></b></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td><b><?= $i ?></b></td>
                                <td><?= $analys['title'] ?></td>
                                <td style="font-size: 25px;"><b><?= json_decode($model->analyses_values, true)[$analys['id']] ?></b></td>
                                <td><?= $analys['units'] ?></td>
                                <td><?= nl2br($analys['norm']) ?></td>
                            </tr>
                        <?php $i++; $old_cat_title = $analys['cat_title']; endforeach; ?>
                </table>
        <?php endif; ?>
        <p>Інтерпретація результатів дослідженнь проводиться лише лікарем. Діагноз не може бути встановлений тільки на підставі результатів лабораторних досліджень, також потрібні огляд пацієнта та, можливо, додаткові обстеження.</p>
    </div>

</div>
