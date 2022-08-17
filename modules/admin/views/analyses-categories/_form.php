<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="analyses-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row align-items-center">
        <div class="col-2">
            <div class="custom-control custom-switch">
                <?= $form->field($model, 'status')->checkbox(['0', '1']) ?>
            </div>
        </div>
        <div class="col-10">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'created_at')->textInput() ?>

    <?php // echo $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
