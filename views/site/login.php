<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('lang', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('lang', 'Please fill out the following fields to login:'); ?></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
//        'layout' => 'horizontal',
        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'template' => "<div class=\"row\"><div class=\"col-sm-1\">{label}</div>\n<div class=\"col-sm-3\">{input}{error}</div></div>",
            'labelOptions' => ['class' => 'col-form-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
//            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('lang', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>


        <div class="text-muted">
            <?php echo Yii::t('lang', 'If you forgot your password you can').' '; echo Html::a(Yii::t('lang', 'reset it'), ['site/request-password-reset']); ?>.
        </div>

        <div class="text-muted">
            <?php echo Yii::t('lang', 'If you have not account you can create new').' '; echo Html::a(Yii::t('lang', 'account'), ['site/signup']) ?>.
        </div>

</div>
