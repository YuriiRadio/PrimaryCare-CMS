<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesPackages */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$js = <<<JS
var ids = [];
$(document).ready(function(){
    $(":checkbox[data-id]").click(function(){
        $(this).each(function(i){
            if ($(this).prop("checked")) {
                ids.push($(this).attr("data-id"));
            } else {
                ids.splice(ids.indexOf($(this).attr("data-id")), 1);
            }
            $('#analysespackages-analyses_ids').val(ids.toString());
        });
    });
});
JS;
$this->registerJs($js);
?>

<div class="analyses-packages-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row align-items-center">
        <div class="col-2">
            <div class="custom-control custom-switch">
                <?= $form->field($model, 'status')->checkbox([0, 1]) ?>
            </div>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'is_free')->checkbox(['0', '1']) ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'pac_num')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'cost')->textInput() ?>
        </div>
        <div class="col-2">
            <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'analyses_ids')->textInput(['maxlength' => true]) ?>

    <?php if (!empty($analyses)): ?>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover" style="background:#66cc00">
                    <thead>
                    <th><b>#</b></th>
                    <th><b><?= Yii::t('lang', 'Id') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Category') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Title') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Select') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Units') ?></b></th>
                    </thead>
                    <?php $i = 1; foreach ($analyses as $analys): ?>
                        <tr>
                            <td><b><?= $i ?></b></td>
                            <td><?= $analys['id'] ?></td>
                            <td><?= $analys['cat_title'] ?></td>
                            <td><?= $analys['title'] ?></td>
                            <td><?= Html::input('checkbox', null, null, ['data' => ['id' => $analys['id']]]) ?></td>
                            <td><?= $analys['units'] ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <div class="form-group">
    <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
