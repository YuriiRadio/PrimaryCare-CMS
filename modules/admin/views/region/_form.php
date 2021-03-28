<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'parent_id')->textInput(['maxlength' => true]) ?>
    <div class="form-group field-region-parent_id has-success">
        <label class="control-label" for="region-parent_id"><?= Yii::t('lang', 'Parent region'); ?></label>
        <select id="region-parent_id" class="form-control" name="Region[parent_id]">
            <option value="0"><?= Yii::t('lang', 'Independent region'); ?></option>
            <?php echo app\widgets\TreeMenuWidget::widget(['tpl' => 'select_self_menu', 'className' => app\models\Region::className(), 'model' => $model]); ?>
        </select>
        <div class="help-block"></div>
    </div>

    <hr />

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

    <hr />

    <?php //echo $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
