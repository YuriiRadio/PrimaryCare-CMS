<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\models\Doctor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctor-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2">
            <div class="custom-control custom-switch">
                <?= $form->field($model, 'status')->checkbox([ '0', '1']) ?>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
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
        <div class="col-sm-6 col-md-6 col-lg-6">
            <!-- Навігація institute-->
            <ul class="nav nav-tabs">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <li class="nav-item">
                    <a class="nav-link<?php if ($flagActive) { echo ' active'; } ?>" href="#<?= $i18nMessage->language.'_institute' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a>
                </li>
                <?php $flagActive = false; endforeach; ?>
            </ul>
            <!-- Вміст вкладок institute-->
            <div class="tab-content">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                    <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_institute' ?>">
                        <?php
                            echo $form->field($i18nMessage, "[$index]institute")
                                ->textInput(['maxlength' => true])
                                ->label(Yii::t('lang', 'Institute'));
                        ?>
                    </div>
                <?php $flagActive = false; endforeach; ?>
            </div>
        </div>
    </div>

    <hr />

    <div>
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

    <hr />

    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?php //echo $form->field($model, 'doctors_specialty_id')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'doctor_specialization_id')->dropDownList(\app\models\DoctorSpecializationI18n::find()
            ->select(['name', 'parent_table_id'])
            ->where(['language' => Yii::$app->language])
            ->indexBy('parent_table_id')
            ->column()); ?>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?php //echo  $form->field($model, 'docrors_categories_id')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'doctor_category_id')->dropDownList(app\models\DoctorCategoryI18n::find()
            ->select(['name', 'parent_table_id'])
            ->where(['language' => Yii::$app->language])
            ->indexBy('parent_table_id')
            ->column()); ?>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?php //echo $form->field($model, 'department_id')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'department_id')->dropDownList(app\models\DepartmentI18n::find()
            ->select(['name', 'parent_table_id'])
            ->where(['language' => Yii::$app->language])
            ->indexBy('parent_table_id')
            ->column()); ?>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <?= $form->field($model, 'experience')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <?= $form->field($model, 'schedule')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <?= $form->field($model, 'number_patients')->textInput() ?>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <?= $form->field($model, 'allowed_number_patients')->textInput() ?>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-auto text-center">
            <?= Html::img('@web/web/uploads/doctor-fotos/small/'.$model->imageSmall, ['alt' => @$model->name, 'class' => 'card-img doctor-view-img']) ?>
            <?php if ($model->image <> 'no-image.png'): ?>
                <?= Html::a('<i class="bi bi-trash"></i>', ['doctor/del-image', 'id' => $model->id], ['title' => Yii::t('lang', 'Delete')]) ?>
            <?php endif; ?>
        </div>
    </div>


    <?php if ($model->image == 'no-image.png') :?>
        <?php echo $form->field($model, 'imageFile')->fileInput(['multiple' => false, 'accept' => 'image/*']) ?>
    <?php endif; ?>

    <?php //echo $form->field($model, 'views')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
