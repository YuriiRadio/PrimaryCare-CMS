<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-sm-1 col-md-1">
            <?php //echo $form->field($model, 'status')->textInput() ?>
            <?= $form->field($model, 'status')->checkbox([ '0', '1']) ?>
        </div>
        <div class="col-sm-3 col-md-3">
            <?= $form->field($model, 'position')->dropDownList([ 'top' => 'Top', 'bottom' => 'Bottom', 'left' => 'Left', 'right' => 'Right', 'center' => 'Center',], ['prompt' => '']) ?>
        </div>
        <div class="col-sm-3 col-md-3">
            <?= $form->field($model, 'to_date_normal')->widget(DatePicker::className(), [
                'model' => $model,
                'attribute' => 'to_date_normal',
                'language' => Yii::$app->language,
                'dateFormat' => 'php:d.m.Y',
            ]) ?>
        </div>
        <div class="col-sm-5 col-md-5">
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
        </div>
    </div>

    <hr />

    <?= $form->field($model, 'url_link')->textInput(['maxlength' => true]) ?>

    <hr />

    <div class="form-group">
        <div class="thumbnail pull-left">
            <?= Html::img('@web/web/uploads/banners/'.$model->image, ['alt' => @$model->name ]) ?>
            <?php if ($model->image <> 'no-image.png'): ?>
            <div class="text-center">
                <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['banner/del-image', 'id' => $model->id], ['title' => Yii::t('lang', 'Delete')]) ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <span class="clearfix"></span>

    <?php if ($model->image == 'no-image.png') :?>
        <?php echo $form->field($model, 'imageFile')->fileInput(['multiple' => false, 'accept' => 'image/*']) ?>
    <?php endif; ?>

    <?php //echo $form->field($model, 'clicks')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
