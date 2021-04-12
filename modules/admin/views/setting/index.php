<?php

use yii\helpers\Html;

$this->title = Yii::t('lang', 'Settings');
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="setting-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <table class="table table-hover table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th><b><?= Yii::t('lang', 'Label') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Param') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Value') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Type') ?></b></th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($settings as $key=> $setting): ?>
                <tr>
                    <td><?= Html::encode($setting->label) ?></td>
                    <td><?= Html::encode($setting->param) ?></td>
                    <td><?= Html::encode($setting->value) ?></td>
                    <td><?= Html::encode($setting->type) ?></td>
                    <td><?= Html::a('<i class="bi bi-pencil"></i>',
                            ['update', 'id' => $setting->id], ['title' => Yii::t('lang', 'Update')]) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <?php //echo phpcredits() ; ?>

</div>
