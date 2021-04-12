<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\StaticPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="static-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row align-items-center">
        <div class="col-sm-6 col-md-2 col-lg-2">
            <div class="custom-control custom-switch">
                <?= $form->field($model, 'status')->checkbox([ '0', '1']) ?>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <!-- Навігація title-->
            <ul class="nav nav-tabs">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <li class="nav-item">
                    <a class="nav-link<?php if ($flagActive) { echo ' active'; } ?>" href="#<?= $i18nMessage->language.'_title' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a>
                </li>
                <?php $flagActive = false; endforeach; ?>
            </ul>
            <!-- Вміст вкладок title-->
            <div class="tab-content">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                    <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_title' ?>">
                        <?php
                            echo $form->field($i18nMessage, "[$index]title")
                                ->textInput(['maxlength' => true])
                                ->label(Yii::t('lang', 'Title'));
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
        <div class="col-sm-3 col-md-3 col-lg-3">
            <?= $form->field($model, 'og_image')->textInput(['maxlength' => true])->label("og_image: (/web/uploads/...)") ?>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <!-- Навігація keywords-->
            <ul class="nav nav-tabs">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <li class="nav-item">
                    <a class="nav-link<?php if ($flagActive) { echo ' active'; } ?>" href="#<?= $i18nMessage->language.'_keywords' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a>
                </li>
                <?php $flagActive = false; endforeach; ?>
            </ul>
            <!-- Вміст вкладок keywords-->
            <div class="tab-content">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                    <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_keywords' ?>">
                        <?php
                            echo $form->field($i18nMessage, "[$index]keywords")
                                ->textInput(['maxlength' => true])
                                ->label(Yii::t('lang', 'Keywords'));
                        ?>
                    </div>
                <?php $flagActive = false; endforeach; ?>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <!-- Навігація description-->
            <ul class="nav nav-tabs">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <li class="nav-item">
                    <a class="nav-link<?php if ($flagActive) { echo ' active'; } ?>" href="#<?= $i18nMessage->language.'_description' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a>
                </li>
                <?php $flagActive = false; endforeach; ?>
            </ul>
            <!-- Вміст вкладок description-->
            <div class="tab-content">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                    <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_description' ?>">
                        <?php
                            echo $form->field($i18nMessage, "[$index]description")
                                ->textarea(['maxlength' => true, 'rows' => 2])
                                ->label(Yii::t('lang', 'Description'));
                        ?>
                    </div>
                <?php $flagActive = false; endforeach; ?>
            </div>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <?= $form->field($model, 'position')->dropDownList([ 'footer' => 'Footer', 'header' => 'Header', ], ['prompt' => '']) ?>
        </div>
    </div>


    <?php //echo $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
