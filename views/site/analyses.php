<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\Pjax;

$this->title = Yii::t('lang', 'Analyses');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-analyses">
<?php Pjax::begin(); ?>
    <div class="row">
        <div class="col-4">
            <?php $form = ActiveForm::begin(['id' => 'analyses-form']); ?>
            <?php // echo  $form->field($model, 'declaration_number')->textInput(['maxlength' => true, 'autofocus' => true, 'placeholder' => Yii::t('lang', 'Enter here'),]) ?>
            <?= $form->field($model, 'declaration_number')->widget(\yii\widgets\MaskedInput::class, ['mask' => '[****-****-****]', 'options' => ['style' => 'font-size: 30px']]) ?>
            <?php // echo $form->field($model, 'verifyCode')->widget(Captcha::className(),
//                    [
//                        'template' => '{image}{input}',
//                        'options' => ['placeholder' => Yii::t('lang', 'Enter verification code here')],
//                    ])
            ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('lang', 'Search'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
 <?php Pjax::end(); ?>
    <div class="row">
        <div class="col-12">
            <?php if (!is_null($model_static)) { echo $model_static['body']; } ?>
        </div>
    </div>
</div>

