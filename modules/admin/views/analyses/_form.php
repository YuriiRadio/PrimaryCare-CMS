<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="analyses-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row align-items-center">
        <div class="col-2">
            <div class="custom-control custom-switch">
                <?= $form->field($model, 'status')->checkbox(['0', '1']) ?>
            </div>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'is_free')->checkbox(['0', '1']) ?>
        </div>
        <div class="col-6">
            <?php
            echo $form->field($model, 'analyses_categories_id')->dropdownList(
                    app\models\AnalysesCategories::find()
                    ->select(['title', 'id'])
                    ->where(['status' => app\models\AnalysesCategories::STATUS_ACTIVE])
                    ->indexBy('id')
                    ->column(), ['prompt' => 'Select Category']);
            ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'pac_num')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-10">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'units')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'norm')->textarea(['rows' => 5]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            <?= $form->field($model, 'cost')->textInput() ?>
        </div>
        <div class="col-7">
            <?= $form->field($model, 'device')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?php
            echo $form->field($model, 'department_id')->dropDownList(\app\models\Department::find()
                ->joinWith('i18n')
                ->select([\app\models\DepartmentI18n::tableName() . '.name', \app\models\Department::tableName() . '.id'])
                ->where(['status' => \app\models\Department::STATUS_ACTIVE])
                ->indexBy('id')
                ->column(), ['prompt' => ['text' => Yii::t('lang', 'Please select...'), 'options' => ['disabled' => true]]]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
