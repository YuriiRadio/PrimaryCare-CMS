<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Patients */
/* @var $form yii\widgets\ActiveForm */

$doctors = \app\models\Doctor::find()
        ->joinWith('i18n', false, 'LEFT JOIN')
        ->select([\app\models\DoctorI18n::tableName() . '.name', \app\models\Doctor::tableName() . '.id'])
        ->where(['status' => \app\models\Doctor::STATUS_ACTIVE])
        ->indexBy('id')
        ->column();

?>

<div class="patients-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row align-items-center">
        <div class="col-2">
            <div class="custom-control custom-switch">
                <?= $form->field($model, 'status')->checkbox(['0', '1']) ?>
            </div>
        </div>
        <div class="col-5">
            <?php
//            echo $form->field($model, 'doctor_id')->dropDownList($doctors);
            echo '<div class="form-group required">';
                echo '<label for="patients-doctor">'. Yii::t('lang', 'Doctor') .'</label>';
                echo Html::input('text', '', $doctors[$model->doctor_id], ['id' => 'patients-doctor', 'class' => 'form-control', 'readonly' => true]);
            echo '</div>';
            ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'our_patient')->checkbox(['0', '1']) ?>
        </div>
        <div class="col-3">
            <?php // echo $form->field($model, 'declaration_number')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'declaration_number')->widget(\yii\widgets\MaskedInput::class, ['mask' => '[****-****-****]']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-7">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint(Yii::t('lang', 'Write full name in this field')) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'birth')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'sex')->dropDownList([1 => Yii::t('lang', 'Male'), 0 => Yii::t('lang', 'Female'), 2 => Yii::t('lang', 'It')]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-7">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-5">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
