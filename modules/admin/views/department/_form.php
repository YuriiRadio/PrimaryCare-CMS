<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'status')->checkbox([ '0', '1']) ?>
        </div>
        <div class="col-md-7">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?php echo $form->field($model, 'department_type_id')->dropDownList(\app\models\DepartmentTypeI18n::find()
                ->select(['name', 'parent_table_id'])
                ->where(['language' => Yii::$app->language])
                ->indexBy('parent_table_id')
                ->column());
            ?>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-md-6">
            <div class="form-group field-department-parent_id">
                <label for="department-parent_id"><?= Yii::t('lang', 'Parent'); ?></label>
                <select id="department-parent_id" class="form-control" name="Department[parent_id]">
                    <option value="0"><?= Yii::t('lang', 'Parent'); ?></option>
                    <?php echo app\widgets\TreeMenuWidget::widget(['tpl' => 'select_self_menu', 'className' => app\models\Department::className(), 'model' => $model]); ?>
                </select>
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'region_id')->dropDownList(\app\models\RegionI18n::find()
                ->select(['name', 'parent_table_id'])
                ->where(['language' => Yii::$app->language])
                ->indexBy('parent_table_id')
                ->column());
            ?>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-md-4">
            <!-- Навігація name-->
            <ul class="nav nav-tabs">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <li class="nav-item">
                    <a class="nav-link<?php if ($flagActive) { echo ' active'; } ?>" href="#<?= $i18nMessage->language.'_name' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a>
                </li>
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
        <div class="col-md-4">
            <!-- Навігація street-->
            <ul class="nav nav-tabs">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <li class="nav-item">
                    <a class="nav-link<?php if ($flagActive) { echo ' active'; } ?>" href="#<?= $i18nMessage->language.'_street' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a>
                </li>
                <?php $flagActive = false; endforeach; ?>
            </ul>
            <!-- Вміст вкладок street-->
            <div class="tab-content">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                    <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_street' ?>">
                        <?php
                            echo $form->field($i18nMessage, "[$index]street")
                                ->textInput(['maxlength' => true])
                                ->label(Yii::t('lang', 'Street'));
                        ?>
                    </div>
                <?php $flagActive = false; endforeach; ?>
            </div>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'building')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'zip_code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <!-- Навігація body-->
            <ul class="nav nav-tabs">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <li class="nav-item">
                    <a class="nav-link<?php if ($flagActive) { echo ' active'; } ?>" href="#<?= $i18nMessage->language.'_body' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a>
                </li>
                <?php $flagActive = false; endforeach; ?>
            </ul>
            <!-- Вміст вкладок body-->
            <div class="tab-content">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                    <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_body' ?>">
                        <?php
                            echo $form->field($i18nMessage, "[$index]body")->widget(CKEditor::className(), [
                                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                                    'preset' => 'full', # Набори інструментів basic, standard, full
                                    'inline' => false,
                                ])
                            ]);
                        ?>
                    </div>
                <?php $flagActive = false; endforeach; ?>
            </div>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'latitude')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'longitude')->textInput() ?>
        </div>
    </div>

    <?php //echo $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <hr />

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
