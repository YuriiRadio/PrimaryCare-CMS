<?php

use yii\helpers\Html;

$this->title = Yii::t('lang', 'Settings');
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="setting-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <table class="table table-hover table-bordered">
                <tr>
                    <th><b><?= Yii::t('lang', 'Label') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Param') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Value') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Type') ?></b></th>
                    <th></th>
                </tr>
                <?php foreach ($settings as $index => $setting): ?>
                <tr>
                    <td><?= Html::encode($setting->label) ?></td>
                    <td><?= Html::encode($setting->param) ?></td>
                    <td><?= Html::encode($setting->value) ?></td>
                    <td><?= Html::encode($setting->type) ?></td>
                    <td><?= Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            ['update', 'id' => $setting->id], ['title' => Yii::t('lang', 'Update')]) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <?php //echo phpcredits() ; ?>

</div>
