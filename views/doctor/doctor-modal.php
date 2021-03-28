<?php

use yii\helpers\Html;

?>

<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="thumbnail">
            <?= Html::img('@web/web/uploads/doctor-fotos/small/'.$model->imageSmall, ['alt' => @$model->name]) ?>
        </div>
    </div>
    <div class="col-sm-8 col-md-8">
        <table class="table table-hover">
            <tr>
                <td><b><?= Yii::t('lang', 'Specialization') ?>:</b></td>
                <td><?= @$model->specialization->name ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Category') ?>:</b></td>
                <td><?= @$model->category->name ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Experience') ?>:</b></td>
                <td><?= $model->experience.Yii::t('lang', 'Y.') ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Work place') ?>:</b></td>
                <td><?= Html::a(@$model->department->name, ['department/view', 'id' => $model->department_id]) ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Schedule') ?>:</b></td>
                <td><?= @$model->schedule ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Education') ?>:</b></td>
                <td><?= @$model->institute ?></td>
            </tr>
        </table>
    </div>
</div>


