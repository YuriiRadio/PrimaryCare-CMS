<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <div>
        <!-- Навігація name-->
        <ul class="nav nav-tabs">
            <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
            <li<?php if ($flagActive) { echo ' class="active"'; } ?>><a href="#<?= $i18nMessage->language.'_name' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a></li>
            <?php $flagActive = false; endforeach; ?>
        </ul>
        <!-- Вміст вкладок name-->
        <div class="tab-content">
            <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_name' ?>">
                    <?php
                        echo $form->field($i18nMessage, "[$index]name")
                            ->textInput(['maxlength' => true])
                            ->label(Yii::t('lang', 'Name'));
                    ?>
                </div>
            <?php $flagActive = false; endforeach; ?>
        </div>
    </div>

    <?php //echo $form->field($model, 'created_at')->hiddenInput(['maxlength' => true, 'value' => 1]) ?>

    <?php //echo $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
