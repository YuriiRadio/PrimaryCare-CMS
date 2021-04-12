<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row align-items-center">
        <div class="col-3">
            <div class="custom-control custom-switch">
                <?= $form->field($model, 'status')->checkbox([ '0', '1']) ?>
            </div>
        </div>
        <div class="col-9">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-6">
            <?php //echo $form->field($model, 'parent_id')->textInput(['maxlength' => true]) ?>
            <div class="form-group field-articlecategory-parent_id has-success">
                <label class="control-label" for="articlecategory-parent_id"><?= Yii::t('lang', 'Parent category'); ?></label>
                <select id="articlecategory-parent_id" class="form-control" name="ArticleCategory[parent_id]">
                    <option value="0"><?= Yii::t('lang', 'Independent category'); ?></option>
                    <?php echo app\widgets\TreeMenuWidget::widget(['tpl' => 'select_self_menu', 'className' => \app\models\ArticleCategory::className(), 'model' => $model]); ?>
                </select>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-6">
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
    </div>

    <hr />

    <div class="row">
        <div class="col-6">
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
        <div class="col-6">
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
    </div>

    <hr />

    <?php //echo $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
