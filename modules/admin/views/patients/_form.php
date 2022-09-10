<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Patients */
/* @var $form yii\widgets\ActiveForm */
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
            echo $form->field($model, 'doctor_id')->dropDownList(\app\models\Doctor::find()
                ->joinWith('i18n')
                ->select([\app\models\DoctorI18n::tableName() . '.name', \app\models\Doctor::tableName() . '.id'])
//                ->with('i18n')
                ->where(['status' => \app\models\Doctor::STATUS_ACTIVE])
                ->indexBy('id')
                ->column());
            ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'our_patient')->checkbox(['0', '1']) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'declaration_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-7">
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
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

    <?php // echo $form->field($model, 'created_at')->textInput() ?>
<?php // echo $form->field($model, 'updated_at')->textInput()  ?>

    <div class="form-group">
<?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
