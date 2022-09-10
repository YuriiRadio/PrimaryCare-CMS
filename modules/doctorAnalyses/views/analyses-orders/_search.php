<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesOrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="analyses-orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

        <div class="row align-items-center">
            <div class="col-2">
                <?php // echo $form->field($model, 'id') ?>
                <?= $form->field($model, 'status')->dropDownList(['' => '', 0 => Yii::t('lang', 'New'), 1 => Yii::t('lang', 'Edited'), 2 => Yii::t('lang', 'Done')]) ?>
            </div>
            <div class="col-3">
                <?php
                    echo $form->field($model, 'doctor_id')->dropDownList(\app\models\Doctor::find()
                        ->joinWith('i18n', false)
                        ->select([\app\models\DoctorI18n::tableName() . '.name', \app\models\Doctor::tableName() . '.id'])
                        ->where(['status' => \app\models\Doctor::STATUS_ACTIVE])
                        ->indexBy('id')
                        ->column());
                ?>
            </div>
            <div class="col-2">
                <?= $form->field($model, 'patient_id') ?>
            </div>
        </div>

        <?php // echo $form->field($model, 'views') ?>

        <?php // echo $form->field($model, 'created_at') ?>

        <?php // echo $form->field($model, 'updated_at') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('lang', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('lang', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
