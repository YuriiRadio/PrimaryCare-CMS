<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('lang', 'Update setting').': '.$model->label;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label];
$this->params['breadcrumbs'][] = Yii::t('lang', 'Update');

?>

<div class="setting-form">

    <h2><?= Html::encode($this->title) ?></h2>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <table class="table table-hover table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th><b><?= Yii::t('lang', 'Label') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Param') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Value') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Default') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Type') ?></b></th>
                    </tr>
                </thead>
                <tr>
                    <td><?= Html::encode($model->label) ?></td>
                    <td><?= Html::encode($model->param) ?></td>
                    <td>
                        <?php if ($model->type == 'string' || $model->type == 'integer') {
                                echo $form->field($model, 'value')->textInput(['maxlength' => true])
                                        ->label(false);
                            }

                            if ($model->type == 'text') {
                                echo $form->field($model, 'value')->textarea(['maxlength' => true, 'rows' => 6])
                                        ->label(false);
                            }
                        ?>
                    </td>
                    <td><?= Html::encode($model->default) ?></td>
                    <td><?= Html::encode($model->type) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

