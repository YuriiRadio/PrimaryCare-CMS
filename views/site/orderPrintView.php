<?php
use yii\helpers\Html;

?>

<div class="analys-order-view">

    <p>
        <?= Html::a('<i class="bi bi-printer-fill"></i>&nbsp;' . Yii::t('lang', 'Print Result'), null, ['class' => 'btn btn-info', 'onclick' => 'PrintElem(\'#print-analys-content\')']) ?>
    </p>

    <div id="print-analys-content">
        <table class="table table-hover" <?= $order->status === 0 ? 'style="background: #FF9200"' : 'style="background: #00cc66"' ?>>
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
                    <td><?= Yii::t('lang', 'Order') ?>:<b><?= ' #' . $order->id ?></b> від&nbsp;<b><?= date('d.m.Y', $order->created_at) ?></b></td>
                    <td colspan="2"><?= Yii::t('lang', 'Patient') ?>:&nbsp;<b><?= $order->patient->name ?></b></td>
                </tr>
                <tr>
                    <td><?= Yii::t('lang', 'Date of biomaterial') ?>:&nbsp;<b><?= date('d.m.Y', $order->date_biomaterial) ?></b></td>
                    <td><?= Yii::t('lang', 'Birth') ?>:&nbsp;<b><?= date('d.m.Y', strtotime($order->patient->birth)) . ' (' . substr(date('Ymd') - date('Ymd', strtotime($order->patient->birth)), 0, -4) . ')' ?></b></td>
                    <td><?= Yii::t('lang', 'Sex') ?>:&nbsp;<b>
                        <?php
                            if ($order->patient->sex == 1) { echo Yii::t('lang', 'Male'); }
                            elseif ($order->patient->sex == 0) { echo Yii::t('lang', 'Female'); }
                            elseif ($order->patient->sex == 2) { echo Yii::t('lang', 'It'); }
                        ?>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><?= Yii::t('lang', 'Doctor') ?>:&nbsp;<b><?= $order->doctor->name ?></b></td>
                </tr>
                <tr>
                    <td colspan="3"><?= Yii::t('lang', 'Laborant(s)') ?>:&nbsp;<b>Іванова Іванна Іванівна</b></td>
                </tr>
            </tbody>
        </table>

        <?php if (!empty($order->analyses_values)): ?>
                <table class="table table-hover" <?= $order->status === $order::STATUS_NEW || $order->status === $order::STATUS_EDITED ? 'style="background: #FF9200"' : 'style="background: #00cc66"' ?>>
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
                                <td style="font-size: 25px;"><b><?= json_decode($order->analyses_values, true)[$analys['id']] ?></b></td>
                                <td><?= $analys['units'] ?></td>
                                <td><?= nl2br($analys['norm']) ?></td>
                            </tr>
                        <?php $i++; $old_cat_title = $analys['cat_title']; endforeach; ?>
                </table>
        <?php endif; ?>
        <p>Інтерпретація результатів дослідженнь проводиться лише лікарем. Діагноз не може бути встановлений тільки на підставі результатів лабораторних досліджень, також потрібні огляд пацієнта та, можливо, додаткові обстеження.</p>
    </div>

</div>
